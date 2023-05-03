<?php

namespace App\Console\Commands;

use App\Models\Course;
use GuzzleHttp\Client;
use Illuminate\Console\Command;
use ZipArchive;

class ParsCourses extends Command
{
    protected $signature = 'app:parser-courses';

    protected $description = 'Парс выгодных курсов с BestChange';

    private $zipFilePath;
    private $bmRatesFilePath;

    public function handle()
    {
        $this->DownloadFile();
        $this->addCourses();
    }
    private function DownloadFile()
    {
        $client = new Client();
        $response = $client->get('http://api.bestchange.ru/info.zip');
        $zipData = $response->getBody()->getContents();
        $this->zipFilePath = storage_path('app/bm_rates.zip');
        file_put_contents($this->zipFilePath, $zipData);

        $zip = new ZipArchive();
        $zip->open($this->zipFilePath);
        $bmRatesData = $zip->getFromName('bm_rates.dat');
        $zip->close();

        $this->bmRatesFilePath = storage_path('app/bm_rates.dat');
        file_put_contents($this->bmRatesFilePath, $bmRatesData);

        $this->info('Файл скачен. '.date('H:i:s',time()));
    }
    private function parseFile () : array
    {
        $content = file($this->bmRatesFilePath, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        $data = [];
        // формируем массив
        foreach ($content as $line) {
            $values = explode(';', $line);
            $data[] = [
                'send_currency' => $values[0],
                'receive_currency' => $values[1],
                'send_rate' => $values[3],
                'receive_rate' => $values[4],
            ];
        }
        $pairs = [];
        // группируем по парам
        foreach ($data as $item) {
            $pair = "{$item['send_currency']}_{$item['receive_currency']}";
            $pairs[$pair][] = $item;
        }
        $pairsNew = [];
        // поиск максимального выгодного курса для пары
        foreach ($pairs as $k => $item) {
            $receive_rates = array_column($item, 'receive_rate');
            $max_receive_rate = max($receive_rates);
            $max_key = array_search($max_receive_rate, $receive_rates);
            $pairsNew[$k] = $item[$max_key];
        }
        return $pairsNew;
    }
    private function addCourses()
    {
        // разбиение по 1000 и запись в БД так как у нас примерно 28 000 записей пар
        $chunks = array_chunk($this->parseFile(), 1000);
        Course::truncate();
        foreach ($chunks as $chunk) {
            Course::insert($chunk);
        }
        // удаляем архив и файл что парсили
        $this->clearFile();

        $this->info('Данные обновлены. '.date('H:i:s',time()));
    }
    private function clearFile(){
        unlink($this->zipFilePath);
        unlink($this->bmRatesFilePath);
    }
}