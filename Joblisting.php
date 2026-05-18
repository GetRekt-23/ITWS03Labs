<?php
$ligtings = [
    [
        'id' => 1,
        'title' => 'Software Engineer',
        'description' => 'We are looking for a skilled software engineer to develop high-quality web applications.',
        'salary' => 80000,
        'location' => 'San Francisco',
        'tags' => ['Software Development', 'PHP', 'JavaScript']
    ],
    [
        'id' => 2,
        'title' => 'Web Developer',
        'description' => 'Responsible for creating and maintaining responsive websites and web systems.',
        'salary' => 60000,
        'location' => 'New York',
        'tags' => ['HTML', 'CSS', 'JavaScript']
    ],
    [
        'id' => 3,
        'title' => 'Backend Developer',
        'description' => 'Develops server-side logic, APIs, and database structures for web applications.',
        'salary' => 75000,
        'location' => 'Chicago',
        'tags' => []
    ],
    [
        'id' => 4,
        'title' => 'Mobile App Developer',
        'description' => 'Builds and maintains mobile applications for Android and iOS platforms.',
        'salary' => 70000,
        'location' => 'Los Angeles',
        'tags' => ['Flutter', 'Android', 'iOS']
    ],
    [
        'id' => 5,
        'title' => 'Data Analyst',
        'description' => 'Analyzes data to help businesses make informed decisions.',
        'salary' => 65000,
        'location' => 'Seattle',
        'tags' => ['Data Analysis', 'Python', 'SQL']
    ]
];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Assessment 2</title>
</head>

<body class="bg-slate-50 text-slate-800 font-sans antialiased">
   
    <header class="bg-slate-900 text-white p-6 shadow-sm">
        <div class="container mx-auto">
            <h1 class="text-3xl font-bold tracking-tight">Job Listings</h1>
        </div>
    </header>

    <div class="container mx-auto max-w-4xl p-4 mt-6">
        

        <?php foreach ($ligtings as $index => $job): ?>
            <div class="mb-4">
                <?= $index % 2 === 0 
                    ? '<div class="bg-white border border-slate-200 rounded-xl shadow-sm hover:shadow-md transition-shadow">' 
                    : '<div class="bg-slate-50 border border-slate-200 rounded-xl shadow-sm hover:shadow-md transition-shadow">' 
                ?>
                <div class="p-6">
                    <h2 class="text-xl font-bold text-slate-900"><?= $job['title'] ?></h2>
                    <p class="text-slate-600 text-base mt-2 leading-relaxed"><?= $job['description'] ?></p>
                    
                    <ul class="mt-4 space-y-2 text-sm border-t border-slate-100 pt-4">
                        <li class="flex items-center text-slate-600">
                            <strong class="w-24 text-slate-500 font-medium">Salary:</strong> 
                            <span class="font-semibold text-slate-900">$<?= number_format($job['salary']) ?></span>
                        </li>
                        <li class="flex items-center text-slate-600">
                            <strong class="w-24 text-slate-500 font-medium">Location:</strong> 
                            <span class="text-slate-900 font-medium"><?= $job['location'] ?></span>
                            
                            <?= $job['location'] === 'New York' 
                                ? '<span class="text-xs font-semibold text-emerald-700 bg-emerald-50 border border-emerald-200 rounded-full px-2.5 py-0.5 ml-3">Remote</span>' 
                                : '<span class="text-xs font-semibold text-slate-600 bg-slate-100 border border-slate-200 rounded-full px-2.5 py-0.5 ml-3">On Site</span>'  
                            ?>
                        </li>
                        <?php if (!empty($job['tags'])): ?>
                            <li class="flex items-start text-slate-600 pt-1">
                                <strong class="w-24 text-slate-500 font-medium mt-1">Tags:</strong> 
                                <div class="flex flex-wrap gap-1.5">
                                    <?php foreach ($job['tags'] as $tag): ?>
                                        <span class="text-xs font-medium text-indigo-700 bg-indigo-50 border border-indigo-100 rounded-md px-2 py-0.5">
                                            <?= $tag ?>
                                        </span>
                                    <?php endforeach; ?>
                                </div>
                            </li>
                        <?php endif ?>
                    </ul>
                </div>
                </div> 
            </div>
        <?php endforeach ?>
    </div>
</body>

</html>