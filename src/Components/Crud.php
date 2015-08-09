<?php

namespace Components;

use NewsProvider\NewsProviderInterface;

class Crud
{
    const MAX_TEST_LENGTH = 200;
    protected $provider = null;

    public function __construct(NewsProviderInterface $provider)
    {
        $this->provider = $provider;
    }

    public function index()
    {
        $news = $this->provider->getFirstBunch();
        $html = '';
        $lastId = null;
        foreach ($news as $oneNews) {
            $html .= $this->buildNewsRow($oneNews);
            $lastId = $oneNews['id'];
        }
        $html .= '<input hidden="hidden" id="last-id" value="' . $lastId. '"/>';
        echo $html;
    }

    public function get()
    {
        $lastId = $_POST['lastId'];
        $news = $this->provider->getNextBunch($lastId);
        $html = '';
        $result = false;
        if (count($news)) {
            foreach ($news as $oneNews) {
                $html .= $this->buildNewsRow($oneNews);
                $lastId = $oneNews['id'];
            }
            $result = true;
        }
        $response = [
            'result' => $result,
            'lastId' => $lastId,
            'html' => $html
        ];
        echo json_encode($response);
    }

    protected function buildNewsRow($news)
    {
        $text = strlen($news['text']) <= self::MAX_TEST_LENGTH
            ? $news['text']
            : substr($news['text'], 0, self::MAX_TEST_LENGTH) . '...';
        $html = <<< HTML
<div class="row news-row" data-id="{$news['id']}" style="height: 180px">
    <div class="col-sm-10">
        <div class="news-title">
            <h3>{$news['title']}</h3>
            <small class="text-muted">
                {$news['updated_at']}
            </small>
        </div>
        <div class="news-text">{$text}</div>
        <div class="news-controls" style="padding-top: 15px">
            <div class="btn-group btn-group-sm" role="group" aria-label="...">
              <button type="button" class="btn  btn-info">More</button>
              <button type="button" class="btn btn-warning">Edit</button>
              <button type="button" class="btn btn-danger">Delete</button>
            </div>
        </div>
    </div>
</div>

<div class="row divider">
    <div class="col-sm-12"><hr></div>
</div>
HTML;
        return $html;
    }
}