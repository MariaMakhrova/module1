<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Список студентів</title>
</head>
<body>
<h1>Список студентів</h1>

<form>
    <label for="specialty">Оберіть спеціальність:</label>
    <select id="specialty" name="specialty">
        <option value="all">Усі спеціальності</option>
        <option value="informatics">Інформатика</option>
        <option value="mathematics">Математика</option>
    </select>
    <button type="submit">Показати</button>
</form>

<ul id="studentList">

</ul>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const form = document.querySelector('form');
        const studentList = document.getElementById('studentList');

        form.addEventListener('submit', function (event) {
            event.preventDefault();

            const specialtySelect = document.getElementById('specialty');
            const selectedSpecialty = specialtySelect.value;

            // Очищення списку перед вставкою нових даних
            studentList.innerHTML = '';

            // Виклик AJAX-запиту для отримання студентів з обраною спеціальністю
            fetch(`server.php?specialty=${selectedSpecialty}`)
                .then(response => response.json())
                .then(students => {
                    students.forEach(student => {
                        const listItem = document.createElement('li');
                        listItem.textContent = `${student.name} - Курс ${student.course}, Спеціальність: ${student.specialty}`;
                        studentList.appendChild(listItem);
                    });
                });
        });
    });
</script>
</body>
</html>
