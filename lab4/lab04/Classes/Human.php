<?php
// Classes/Human.php
require_once __DIR__ . '/Cleaning.php';

/**
 * Абстрактний клас людини
 *
 * Базовий клас для різних типів людей
 */
abstract class Human implements Cleaning {
    private $height;
    private $weight;
    private $age;

    /**
     * Конструктор класу Human
     *
     * @param float $height Зріст людини
     * @param float $weight Вага людини
     * @param int $age Вік людини
     */
    public function __construct($height, $weight, $age) {
        $this->height = $height;
        $this->weight = $weight;
        $this->age = $age;
    }

    /**
     * Отримання зросту
     *
     * @return float Зріст людини
     */
    public function getHeight() {
        return $this->height;
    }

    /**
     * Встановлення зросту
     *
     * @param float $height Новий зріст
     */
    public function setHeight($height) {
        $this->height = $height;
    }

    /**
     * Отримання ваги
     *
     * @return float Вага людини
     */
    public function getWeight() {
        return $this->weight;
    }

    /**
     * Встановлення ваги
     *
     * @param float $weight Нова вага
     */
    public function setWeight($weight) {
        $this->weight = $weight;
    }

    /**
     * Отримання віку
     *
     * @return int Вік людини
     */
    public function getAge() {
        return $this->age;
    }

    /**
     * Встановлення віку
     *
     * @param int $age Новий вік
     */
    public function setAge($age) {
        $this->age = $age;
    }

    /**
     * Метод народження дитини
     *
     * @return string Повідомлення про народження дитини
     */
    public function birthChild() {
        return $this->birthMessage();
    }

    /**
     * Абстрактний метод повідомлення при народженні дитини
     *
     * @return string Повідомлення
     */
    abstract protected function birthMessage();
}