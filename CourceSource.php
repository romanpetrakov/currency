<?php


class CourceSource implements CourceSourceInterface
{
    private $url;

    public function __construct(string $url) {
        $this->url = $url;
    }

    public function get(): string
    {
        // обращаемся к ресурсу. смотрим коды ответа если не 200 кидаем эксепшн
        //возвращаем тело ответа
        return '';
    }

    /**
     * @param string $raw
     * @return Cource[]
     */
    public function parse(string $raw): array
    {
        /**
         * парсим пришедшие данные и из них формируем массив объектов курсов
         */

        return [];
    }

}