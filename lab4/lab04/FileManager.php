<?php
// FileManager.php
/**
 * Клас для роботи з файлами
 *
 * Надає статичні методи для читання, запису та очищення файлів
 */
class FileManager {
    /**
     * Директорія для зберігання файлів
     *
     * @var string
     */
    public static $dir = 'text';

    /**
     * Запис тексту у файл
     *
     * @param string $filename Ім'я файлу
     * @param string $text Текст для запису
     */
    public static function writeToFile($filename, $text) {
        file_put_contents(self::$dir . "/" . $filename, $text . PHP_EOL, FILE_APPEND);
    }

    /**
     * Читання вмісту файлу
     *
     * @param string $filename Ім'я файлу
     * @return string Вміст файлу
     */
    public static function readFromFile($filename) {
        return file_get_contents(self::$dir . "/" . $filename);
    }

    /**
     * Очищення вмісту файлу
     *
     * @param string $filename Ім'я файлу
     */
    public static function clearFile($filename) {
        file_put_contents(self::$dir . "/" . $filename, '');
    }
}