<?php
// Circle.php
/**
 * Клас кола
 *
 * Представляє коло з координатами центру та радіусом
 */
class Circle {
    private $x;
    private $y;
    private $radius;

    /**
     * Конструктор класу
     *
     * @param float $x Координата X центру кола
     * @param float $y Координата Y центру кола
     * @param float $radius Радіус кола
     */
    public function __construct($x, $y, $radius) {
        $this->x = $x;
        $this->y = $y;
        $this->radius = $radius;
    }

    /**
     * Отримання координати X
     *
     * @return float Координата X
     */
    public function getX() {
        return $this->x;
    }

    /**
     * Отримання координати Y
     *
     * @return float Координата Y
     */
    public function getY() {
        return $this->y;
    }

    /**
     * Отримання радіусу
     *
     * @return float Радіус
     */
    public function getRadius() {
        return $this->radius;
    }

    /**
     * Встановлення координати X
     *
     * @param float $x Нова координата X
     */
    public function setX($x) {
        $this->x = $x;
    }

    /**
     * Встановлення координати Y
     *
     * @param float $y Нова координата Y
     */
    public function setY($y) {
        $this->y = $y;
    }

    /**
     * Встановлення радіусу
     *
     * @param float $radius Новий радіус
     */
    public function setRadius($radius) {
        $this->radius = $radius;
    }

    /**
     * Перетворення об'єкта в рядок
     *
     * @return string Рядкове представлення кола
     */
    public function __toString() {
        return "Коло з центром в ({$this->x}, {$this->y}) і радіусом {$this->radius}";
    }

    /**
     * Перевіряє, чи перетинається коло з іншим
     *
     * @param Circle $other Інше коло
     * @return bool true якщо кола перетинаються, false - інакше
     */
    public function intersects(Circle $other) {
        $dx = $this->x - $other->getX();
        $dy = $this->y - $other->getY();
        $distance = sqrt($dx * $dx + $dy * $dy);

        return $distance <= ($this->radius + $other->getRadius());
    }
}