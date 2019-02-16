<?php


class CourseManager
{
    private $db;
    private $cache;

    public function __construct(DB $db, Cache $cache)
    {
        $this->db = $db;
        $this->cache = $cache;
    }

    public function getCource($currencyId, $secondCurrencyId): Cource
    {
        if ($cource = $this->getFromCache($currencyId, $secondCurrencyId)) {
            return $cource;
        }
        $cource = $this->getFromDB($currencyId, $secondCurrencyId);
        if ($cource) {
            $this->setToCache($cource);
        }

        return $cource;
    }

    /**
     * сохраняем данные в базу
     * @param Cource $cource
     */
    public function setToBD(Cource $cource)
    {
        $this->db->add($cource);
    }

    /**
     * @param Cource $cource
     */
    public function setToCache(Cource $cource)
    {
        $key = $this->getCacheKey($cource->currentCurencyId, $cource->secondCurrencyId);
        $this->cache->set($key, serialize($cource));
    }

    private function getFromCache($currentCurencyId, $secondCurrencyId)
    {
        $key = $this->getCacheKey($currentCurencyId, $secondCurrencyId);
        $value = $this->cache->get($key);
        return $value ? unserialize($value) : false;
    }

    public function add(Cource $cource)
    {
        $this->setToBD($cource);
        $this->setToCache($cource);
    }

    /**
     * извлекаем из таблицы последнюю запись с курсом переданных валют
     * @param $currencyId
     * @param $secondCurrencyId
     * @return Cource|boolean
     */
    private function getFromDB($currencyId, $secondCurrencyId)
    {
        return $this->db->get($currencyId, $secondCurrencyId);
    }

    private function getCacheKey($currentCurencyId, $secondCurrencyId)
    {
        return 'cource' . $currentCurencyId . "_" . $secondCurrencyId;
    }
}