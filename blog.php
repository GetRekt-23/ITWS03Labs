<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

$blogTitle = "Blog";
$author = "Ralph Lawrence Labao";
$intro = "Hi! Welcome to my personal blog. Kumain ka na ba?";

$posts = [
    [
        "title" => "My First Blog Post",
        "content" => "This is my first blog post using HTML, PHP, and Tailwind CSS. (Konting tulong ni chatGPT)",
        "date" => "January 22, 2026"
    ],
    [
        "title" => "Who is Ralph?",
        "content" => "Ralph Lawrence Labao is a student at Nueva Ecija University of Science and Technology. A 20-year-old guy who loves to play and analyze video games.",
        "date" => "January 22, 2026"
    ],
    [
        "title" => "Ralph's Take on Music",
        "content" => "He mostly listens to rock and metal. His guitar hero is Kurt Cobain. Favorite bands include Nirvana, Linkin Park, Limp Bizkit. He also listens to OPM bands like Tanya Markova, and Kamikazee.",
        "date" => "January 22, 2026"
    ],
    [
        "title" => "Ralph's Hobbies",
        "content" => "He enjoys playing Mobile Legends and Call of Duty Mobile, and watching car-related anime like Initial D and Wangan Midnight.",
        "date" => "January 22, 2026"
    ]
];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title><?php echo $blogTitle; ?></title>
</head>

<body class="bg-gradient-to-br from-slate-100 to-slate-200 min-h-screen">

<section class="bg-slate-900 text-white py-16 text-center">
    <h1 class="text-4xl font-bold mb-2"><?php echo $blogTitle; ?></h1>
    <p class="text-gray-300">By <?php echo $author; ?></p>
</section>

<div class="max-w-4xl mx-auto px-6 -mt-10">
    <div class="bg-white rounded-xl shadow-lg p-6 text-center">
        <p class="text-lg"><?php echo $intro; ?></p>
    </div>
</div>

<main class="max-w-6xl mx-auto p-6 mt-10">
    <div class="grid md:grid-cols-2 gap-6">
        <?php foreach ($posts as $post): ?>
            <div class="bg-white rounded-xl shadow p-6">
                <h2 class="text-2xl font-semibold mb-1">
                    <?php echo $post['title']; ?>
                </h2>
                <p class="text-sm text-gray-500 mb-3">
                    <?php echo $post['date']; ?>
                </p>
                <p class="text-gray-700">
                    <?php echo $post['content']; ?>
                </p>
            </div>
        <?php endforeach; ?>
    </div>

<section class="max-w-6xl mx-auto p-6 mt-10">
    <div class="bg-white rounded-xl p-6">
        <h2 class="text-2xl font-semibold mb-6 text-center">
            Random
        </h2>

        <div class="grid grid-cols-2 md:grid-cols-5 gap-4">
            <img src="images/pic1.jpg" class="w-full h-40 object-cover rounded-lg">
            <img src="images/pic2.jpg" class="w-full h-40 object-cover rounded-lg">
            <img src="images/pic3.jpg" class="w-full h-40 object-cover rounded-lg">
            <img src="images/pic4.jpg" class="w-full h-40 object-cover rounded-lg">
            <img src="images/pic5.jpg" class="w-full h-40 object-cover rounded-lg">
        </div>
    </div>
</section>

</main>

<footer class="text-center text-gray-600 py-6 mt-10">
    © 2026 <?php echo $author; ?> • Built with HTML, Tailwind CSS, and PHP
</footer>

</body>
</html>
