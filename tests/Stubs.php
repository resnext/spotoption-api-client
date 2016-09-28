<?php

namespace SpotOption\Tests;

class Stubs
{
    protected static function getStub($file)
    {
        return file_get_contents(__DIR__.DIRECTORY_SEPARATOR.'stubs'.DIRECTORY_SEPARATOR.$file);
    }

    public static function successfulCountriesView()
    {
        return static::getStub('successfulCountriesView.xml');
    }
}
