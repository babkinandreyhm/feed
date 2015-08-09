<?php

namespace NewsProvider;

interface NewsProviderInterface
{
    public function getFirstBunch();

    public function getNextBunch($id);

    public function add();

    public function edit();

    public function delete();
}