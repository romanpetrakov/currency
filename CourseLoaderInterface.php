<?php


interface CourseLoaderInterface
{
    public function __construct(CourceSourceInterface $source);

    public function load(): string;
}