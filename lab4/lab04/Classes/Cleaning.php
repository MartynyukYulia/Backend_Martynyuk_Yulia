<?php
// Classes/Cleaning.php
/**
 * Інтерфейс прибирання
 *
 * Описує методи для прибирання різних частин будинку
 */
interface Cleaning {
    /**
     * Прибирання кімнати
     *
     * @return string Повідомлення про прибирання кімнати
     */
    public function cleanRoom();

    /**
     * Прибирання кухні
     *
     * @return string Повідомлення про прибирання кухні
     */
    public function cleanKitchen();
}