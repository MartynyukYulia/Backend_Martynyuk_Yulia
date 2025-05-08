<?php
// Classes/Programmer.php
require_once __DIR__ . '/Human.php';

/**
 * Клас програміста
 *
 * Представляє людину, яка є програмістом
 */
class Programmer extends Human {
    private $languages = [];
    private $experience;

    /**
     * Конструктор класу Programmer
     *
     * @param float $height Зріст програміста
     * @param float $weight Вага програміста
     * @param int $age Вік програміста
     * @param array $languages Мови програмування
     * @param int $experience Досвід роботи
     */
    public function __construct($height, $weight, $age, $languages, $experience) {
        parent::__construct($height, $weight, $age);
        $this->languages = $languages;
        $this->experience = $experience;
    }

    /**
     * Отримання мов програмування
     *
     * @return array Масив мов програмування
     */
    public function getLanguages() {
        return $this->languages;
    }

    /**
     * Додавання нової мови програмування
     *
     * @param string $lang Нова мова
     */
    public function addLanguage($lang) {
        $this->languages[] = $lang;
    }

    /**
     * Отримання досвіду роботи
     *
     * @return int Досвід роботи
     */
    public function getExperience() {
        return $this->experience;
    }

    /**
     * Встановлення досвіду роботи
     *
     * @param int $experience Новий досвід
     */
    public function setExperience($experience) {
        $this->experience = $experience;
    }

    /**
     * Реалізація абстрактного методу birthMessage
     *
     * @return string Повідомлення про народження дитини
     */
    protected function birthMessage() {
        return "Програміст народив дитину!";
    }

    /**
     * Реалізація інтерфейсу Cleaning
     *
     * @return string Повідомлення про прибирання кімнати
     */
    public function cleanRoom() {
        return "Програміст прибирає кімнату";
    }

    /**
     * Реалізація інтерфейсу Cleaning
     *
     * @return string Повідомлення про прибирання кухні
     */
    public function cleanKitchen() {
        return "Програміст прибирає кухню";
    }
}