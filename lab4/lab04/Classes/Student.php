<?php
// Classes/Student.php
require_once __DIR__ . '/Human.php';

/**
 * Клас студента
 *
 * Представляє людину, яка є студентом
 */
class Student extends Human {
    private $university;
    private $course;

    /**
     * Конструктор класу Student
     *
     * @param float $height Зріст студента
     * @param float $weight Вага студента
     * @param int $age Вік студента
     * @param string $university Університет
     * @param int $course Курс навчання
     */
    public function __construct($height, $weight, $age, $university, $course) {
        parent::__construct($height, $weight, $age);
        $this->university = $university;
        $this->course = $course;
    }

    /**
     * Отримання університету
     *
     * @return string Назва університету
     */
    public function getUniversity() {
        return $this->university;
    }

    /**
     * Встановлення університету
     *
     * @param string $university Новий університет
     */
    public function setUniversity($university) {
        $this->university = $university;
    }

    /**
     * Отримання курсу
     *
     * @return int Курс навчання
     */
    public function getCourse() {
        return $this->course;
    }

    /**
     * Встановлення курсу
     *
     * @param int $course Новий курс
     */
    public function setCourse($course) {
        $this->course = $course;
    }

    /**
     * Переведення на наступний курс
     */
    public function nextCourse() {
        $this->course++;
    }

    /**
     * Реалізація абстрактного методу birthMessage
     *
     * @return string Повідомлення про народження дитини
     */
    protected function birthMessage() {
        return "Студент народив дитину!";
    }

    /**
     * Реалізація інтерфейсу Cleaning
     *
     * @return string Повідомлення про прибирання кімнати
     */
    public function cleanRoom() {
        return "Студент прибирає кімнату";
    }

    /**
     * Реалізація інтерфейсу Cleaning
     *
     * @return string Повідомлення про прибирання кухні
     */
    public function cleanKitchen() {
        return "Студент прибирає кухню";
    }
}