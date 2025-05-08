<?php
// index.php - Main entry point for the application

// Include autoloader
require_once 'autoload.php';

// Use namespaced classes
use Controllers\UserController;
use Models\UserModel;
use Views\UserView;

echo "<h2>PHP Complete Project</h2>";

// --- Testing MVC ---
echo "<h3>Testing MVC Classes:</h3>";
$model = new UserModel();
$controller = new UserController();
$view = new UserView();

echo "Model: " . $model->getMessage() . "<br>";
echo "Controller: " . $controller->processRequest() . "<br>";
echo "View: " . $view->render() . "<br><br>";

// --- Testing FileManager ---
echo "<h3>Testing FileManager:</h3>";
if (!is_dir('text')) {
    mkdir('text');
}
FileManager::writeToFile('file1.txt', "Це перший запис");
FileManager::writeToFile('file2.txt', "Це другий запис");

echo "Вміст файлу file1.txt: " . FileManager::readFromFile('file1.txt');
echo "<br>Вміст файлу file2.txt: " . FileManager::readFromFile('file2.txt');

FileManager::clearFile('file1.txt');
echo "<br><br>Вміст файлу file1.txt після очищення: " . FileManager::readFromFile('file1.txt');
echo "<br>Вміст файлу file2.txt після очищення (має залишитись): " . FileManager::readFromFile('file2.txt') . "<br><br>";

// --- Testing Circle ---
echo "<h3>Testing Circle Class:</h3>";
$c1 = new Circle(0, 0, 5);
$c2 = new Circle(3, 4, 3);
echo $c1 . "<br>";
echo $c2 . "<br>";
echo "Перетинаються? " . ($c1->intersects($c2) ? "Так" : "Ні") . "<br><br>";

// --- Testing OOP (Student & Programmer) ---
echo "<h3>Testing OOP Inheritance:</h3>";
$student = new Student(170, 65, 20, "КПІ", 2);
$student->nextCourse();
$student->setHeight(175);
echo "Студент: Зріст = " . $student->getHeight() . ", Курс = " . $student->getCourse() . "<br>";
echo $student->cleanRoom() . "<br>";
echo $student->birthChild() . "<br><br>";

$programmer = new Programmer(180, 75, 25, ['PHP', 'JS'], 3);
$programmer->addLanguage("Python");
$programmer->setWeight(80);
echo "Програміст: Вага = " . $programmer->getWeight() . ", Мови = " . implode(', ', $programmer->getLanguages()) . "<br>";
echo $programmer->cleanKitchen() . "<br>";
echo $programmer->birthChild() . "<br>";