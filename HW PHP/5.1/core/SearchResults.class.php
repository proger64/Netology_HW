<?php

class SearchResults
{
    protected $api;
    protected $apiResponse;

    public function __construct($searchString, $searchID)
    {
        $this->api = new \Yandex\Geo\Api();

        if (!empty($searchString)) {
            // Если $searchString непустая - используем ее
            $_SESSION['address'] = $searchString;
            $_SESSION['addressID'] = 0;
            $this->api->setQuery(getParam('address'));
        } elseif (!empty($_SESSION['address']) and isset($searchID)) {
            // Если $searchString пустая и непустая строка в сессии
            $this->api->setQuery($_SESSION['address']);
            $_SESSION['addressID'] = isset($searchID) ? $searchID : $_SESSION['addressID'];
        } else {
            $this->api->setQuery('');
        }

        // Настройка фильтров
        $this->api
            ->setLang(\Yandex\Geo\Api::LANG_RU)// локаль ответа
            ->load();

        $this->apiResponse = $this->api->getResponse();
    }

    
    public function getFoundCount()
    {
        return $this->apiResponse->getFoundCount();
    }

   
    public function getSearchQuery()
    {
        return $this->apiResponse->getQuery();
    }

    
    public function getLastSearchID()
    {
        return !empty($_SESSION['addressID']) ? (int)$_SESSION['addressID'] : 0;
    }

    
    public function getItemByID($id)
    {
        $i = 0;
        foreach ($this->getList() as $item) {
            if ($i === $id) {
                return $item;
            }
            $i++;
        }
        return '';
    }

   
    public function getList()
    {
        return $this->apiResponse->getList();
    }
}