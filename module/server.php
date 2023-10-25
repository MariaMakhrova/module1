<?php
// Функція для отримання даних з CSV-файлу
function getStudentsFromCSV() {
    $students = [];
    $file = fopen('students.csv', 'r');
    while (($line = fgetcsv($file)) !== false) {
        $students[] = [
            'id' => $line[0],
            'name' => $line[1],
            'course' => $line[2],
            'specialty' => $line[3],
        ];
    }
    fclose($file);
    return $students;
}

// Функція для збереження даних в CSV-файл
function saveStudentsToCSV($students) {
    $file = fopen('students.csv', 'w');
    foreach ($students as $student) {
        fputcsv($file, $student);
    }
    fclose($file);
}

// Отримання параметра "specialty" з GET-запиту
$selectedSpecialty = isset($_GET['specialty']) ? $_GET['specialty'] : 'all';

// Отримання студентів з CSV-файлу
$students = getStudentsFromCSV();

// Фільтрація студентів за обраною спеціальністю
if ($selectedSpecialty !== 'all') {
    $students = array_filter($students, function ($student) use ($selectedSpecialty) {
        return $student['specialty'] === $selectedSpecialty;
    });
}

// Повернення результатів у JSON-форматі
header('Content-Type: application/json');
echo json_encode($students);

// Збереження змінених даних у CSV-файлі
saveStudentsToCSV($students);
?>

<!-- Цикли в РНР.
Цикли в загальному випадку використовуються для повторення однієї і тієї ж ділянки коду.
Для кожного типу задач підходить свій тип циклу, який відрізняється в основному за змістом і синтаксисом.
Також важливо відзначити, що всі типи циклів конвертуються між собою, просто це не завжди може бути доцільно з точки зору складності коду
та часу обчислень.
У PHP існує кілька типів циклів, які дозволяють виконувати певний блок коду декілька разів.
Ось кілька основних типів циклів в PHP:

1 for загальний цикл, в якому ми заздалегідь знаємо кількість повторень, або можемо просто обчислити її заздалегідь,
2 while, do while загальний цикл, в якому ми не знаємо кількість повторень заздалегідь,
4 foreach Перегляд масивів та об'єктів
5 break і continue





 -->
