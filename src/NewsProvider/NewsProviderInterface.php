<?php

namespace NewsProvider;

interface NewsProviderInterface
{
    public function getFirstBatch();

    public function getNextBatch($id);

    public function get($id);

    public function add($title, $text);

    public function edit($id, $title, $text);

    public function delete($id);
}