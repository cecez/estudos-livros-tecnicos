<?php

interface ThirdPartyYouTubeLib {
    public function listVideos();
    public function getVideoInfo(int $id);
    public function downloadVideo(int $id);
}

class ThirdPartyYouTubeClass implements ThirdPartyYouTubeLib {

    public function listVideos()
    {
        // consulta API do YouTube
    }

    public function getVideoInfo(int $id)
    {
        // Obtém dados do vídeo
    }

    public function downloadVideo(int $id)
    {
        // Baixa vídeo de fato
    }
}

class ProxyCacheClass implements ThirdPartyYouTubeLib {

    private ThirdPartyYouTubeLib $lib;
    private array $listCache, $infoCache, $videoCache;
    public bool $invalidarCache = false;

    public function __construct(ThirdPartyYouTubeLib $lib)
    {
        $this->lib = $lib;
    }

    public function listVideos()
    {
        if (!count($this->listCache) || $this->invalidarCache) {
            $this->listCache = $this->lib->listVideos();
        }
    }

    public function getVideoInfo(int $id)
    {
        if (!isset($this->infoCache[$id]) || $this->invalidarCache) {
            $this->infoCache[$id] = $this->lib->getVideoInfo($id);
        }
    }

    public function downloadVideo(int $id)
    {
        if (!isset($this->videoCache[$id]) || $this->invalidarCache) {
            $this->videoCache[$id] = $this->lib->downloadVideo($id);
        }
    }
}

class YouTubeManager {
    private ThirdPartyYouTubeLib $service;

    public function __construct(ThirdPartyYouTubeLib $service)
    {
        $this->service = $service;
    }

    public function renderVideoPage($id)
    {
        $info = $this->service->getVideoInfo($id);
    }

    public function renderVideoList()
    {
        $info = $this->service->listVideos();
    }
}

// aplicação
$youTubeService = new ThirdPartyYouTubeClass();
$proxy = new ProxyCacheClass($youTubeService);
$manager = new YouTubeManager($proxy);
$manager->renderVideoList();