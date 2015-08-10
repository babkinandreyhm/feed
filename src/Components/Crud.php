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
        $news = $this->provider->getFirstBatch();
        $html = '';
        $lastId = null;
        foreach ($news as $oneNews) {
            $html .= $this->buildNewsRow($oneNews);
            $lastId = $oneNews['id'];
        }
        $html .= '<input hidden="hidden" id="last-id" value="' . $lastId. '"/>';
        return $html;
    }

    public function getBatch()
    {
        $lastId = $_POST['lastId'];
        $news = $this->provider->getNextBatch($lastId);
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
        return $response;
    }

    public function get()
    {
        $news = [];
        if (!isset($_POST['id'])) {
            $result = false;
        } else {
            $news = $this->provider->get($_POST['id']);
            $result = is_array($news) ? true : false;
        }
        $response = [
            'result' => $result,
            'news'   => $news
        ];
        return $response;
    }

    public function edit()
    {
        //todo validate input data
        if (!isset($_POST['id'], $_POST['title'], $_POST['text'])) {
            $result = false;
        } else {
            $result = $this->provider->edit($_POST['id'], $_POST['title'], $_POST['text']);
        }
        return [
            'result' => $result
        ];
    }

    public function add()
    {
        $news = '';
        //todo validate input data
        if (!isset($_POST['title'], $_POST['text'])) {
            $result = false;
        } else {
            if ($id = $this->provider->add($_POST['title'], $_POST['text'])) {
                $result = true;
                $news = $this->buildNewsRow($this->provider->get($id));
            } else {
                $result = false;
            }
        }
        return [
            'result' => $result,
            'news' => $news
        ];
    }

    public function delete()
    {
        if (!isset($_POST['id'])) {
            $result = false;
        } else {
            $result = $this->provider->delete($_POST['id']);
        }
        return [
            'result' => $result
        ];
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
            <h3 class="news-title-header">{$news['title']}</h3>
            <small class="text-muted">
                {$news['updated_at']}
            </small>
        </div>
        <div class="news-text">{$text}</div>
        <div class="news-controls" style="padding-top: 15px">
            <div class="btn-group btn-group-sm" role="group" aria-label="...">
              <button type="button" class="btn btn-info details">More</button>
              <button type="button" class="btn btn-warning edit">Edit</button>
              <button type="button" class="btn btn-danger delete">Delete</button>
            </div>
        </div>
    </div>

    <div class="row divider">
        <div class="col-sm-12"><hr></div>
    </div>
</div>
HTML;
        return $html;
    }
}