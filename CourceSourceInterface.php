<?php


interface CourceSourceInterface
{

    public function parse(string $raw): array;

    public function get(): string;
}