<?php


class CourseLoader implements CourseLoaderInterface
{
    private $source;

    public function __construct(CourceSourceInterface $source)
    {
        $this->source = $source;
    }

    public function load(): string
    {
        try {
            $responce = $this->source->get();
        }catch (Exeption $exception){
            //обрабатываем ошибки. логируем
            return '';
        }
        return $responce;
    }

}