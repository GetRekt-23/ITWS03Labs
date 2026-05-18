<?php
// MUSIC LIBRARY
$songs = [
    [
        "id" => 1,
        "title" => "Iglap",
        "author" => "Tanya Markova",
        "url" => "https://www.soundhelix.com/examples/mp3/SoundHelix-Song-1.mp3"
    ],
    [
        "id" => 2,
        "title" => "Reverend's Daughter",
        "author" => "Typecast",
        "url" => "https://www.soundhelix.com/examples/mp3/SoundHelix-Song-2.mp3"
    ],
    [
        "id" => 3,
        "title" => "Daliri",
        "author" => "Kjwan",
        "url" => "https://www.soundhelix.com/examples/mp3/SoundHelix-Song-3.mp3"
    ],
    [
        "id" => 4,
        "title" => "Carino Brutal",
        "author" => "Slapshock",
        "url" => "https://www.soundhelix.com/examples/mp3/SoundHelix-Song-4.mp3"
    ],
    [
        "id" => 5,
        "title" => "Sobrang Init",
        "author" => "Kamikazee",
        "url" => "https://www.soundhelix.com/examples/mp3/SoundHelix-Song-5.mp3"
    ]
];


interface Playable
{
    public function playMessage();
}


abstract class Account
{
    protected $username;
    protected $plan;

    public function __construct($username, $plan)
    {
        $this->username = $username;
        $this->plan = $plan;
    }

    public function getUsername() { return $this->username; }
    public function getPlan() { return $this->plan; }

    public function getInfo()
    {
        return "User: " . htmlspecialchars($this->username) . " | Plan: " . $this->plan;
    }
}


class Free extends Account implements Playable
{
    public function __construct($username)
    {
        parent::__construct($username, "Free");
    }

    public function playMessage()
    {
        return "Playing with Interruptive Audio Ads";
    }
}

class Premium extends Account implements Playable
{
    private $price = 199;

    public function __construct($username)
    {
        parent::__construct($username, "Premium");
    }

    public function getPayment()
    {
        return "Subscription Fee: ₱" . $this->price . "/month (Ad-Free Experience)";
    }

    public function playMessage()
    {
        return "Premium High-Fidelity Audio — No Ads";
    }
}


if (isset($_POST['logout'])) {
    setcookie("user_auth", "", time() - 3600, "/");
    setcookie("user_plan", "", time() - 3600, "/");
    header("Location: " . $_SERVER['PHP_SELF']);
    exit;
}

if (isset($_POST['account'])) {
    setcookie("user_auth", $_POST['username'], time() + 3600, "/");
    setcookie("user_plan", $_POST['account'], time() + 3600, "/");
    header("Location: " . $_SERVER['PHP_SELF']);
    exit;
}


$account = null;
if (isset($_COOKIE['user_auth'])) {
    $username = $_COOKIE['user_auth'];
    $account = ($_COOKIE['user_plan'] === "premium") ? new Premium($username) : new Free($username);
}


$currentSong = null;
if (isset($_GET['play_id'])) {
    foreach ($songs as $song) {
        if ($song['id'] == $_GET['play_id']) {
            $currentSong = $song;
            break;
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" />
    <title>Spotibai — Personal Audio Architecture</title>
</head>
<body class="bg-slate-950 text-slate-100 font-sans antialiased min-h-screen flex flex-col justify-between">

    
    <header class="border-b border-slate-800 bg-slate-900/50 backdrop-blur sticky top-0 z-50">
        <div class="container mx-auto max-w-4xl px-4 h-16 flex items-center justify-between">
            <div class="flex items-center space-x-2">
                <div class="h-8 w-8 bg-emerald-500 rounded-lg flex items-center justify-center text-slate-950 font-black"><i class="fa fa-play text-xs"></i></div>
                <span class="font-bold text-lg tracking-tight">Spotibai</span>
            </div>
            <?php if ($account): ?>
                <form method="POST">
                    <button name="logout" class="text-xs font-semibold px-3 py-1.5 bg-slate-800 hover:bg-red-950 hover:text-red-400 rounded-md transition-colors border border-slate-700 hover:border-red-900">
                        <i class="fa fa-sign-out-alt mr-1"></i> Disconnect
                    </button>
                </form>
            <?php endif; ?>
        </div>
    </header>

    
    <main class="container mx-auto max-w-4xl px-4 py-8 flex-grow">
        
        
        <?php if (!$account): ?>
            <div class="max-w-md mx-auto bg-slate-900 border border-slate-800 rounded-2xl p-8 shadow-2xl mt-12">
                <div class="text-center mb-6">
                    <h2 class="text-xl font-bold tracking-tight">Access Music Interface</h2>
                    <p class="text-xs text-slate-400 mt-1">Authenticate credentials to initiate playback nodes.</p>
                </div>
                <form method="POST" class="space-y-4">
                    <div>
                        <label class="block text-xs font-semibold uppercase tracking-wider text-slate-400 mb-1.5">Username Reference</label>
                        <input type="text" name="username" placeholder="lodicakes" required 
                               class="w-full bg-slate-950 border border-slate-800 rounded-xl px-4 py-2.5 text-sm text-slate-100 placeholder-slate-600 focus:outline-none focus:border-emerald-500 transition-colors">
                    </div>
                    <div class="grid grid-cols-2 gap-3 pt-2">
                        <button name="account" value="free" class="w-full py-2.5 rounded-xl text-xs font-bold bg-slate-800 hover:bg-slate-700 text-slate-200 transition">
                            Free Cluster
                        </button>
                        <button name="account" value="premium" class="w-full py-2.5 rounded-xl text-xs font-bold bg-emerald-500 hover:bg-emerald-400 text-slate-950 transition">
                            Premium Access
                        </button>
                    </div>
                </form>
            </div>
        <?php endif; ?>

        
        <?php if ($account): ?>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 items-start">
                
                
                <div class="space-y-4">
                    <div class="bg-slate-900 border border-slate-800 rounded-2xl p-5">
                        <h3 class="text-xs font-bold tracking-wider uppercase text-slate-500 mb-3">User Authorization</h3>
                        <div class="space-y-1.5 text-sm">
                            <div class="text-slate-400">Node: <span class="font-bold text-slate-100"><?= htmlspecialchars($account->getUsername()); ?></span></div>
                            <div class="text-slate-400">Tier: 
                                <span class="text-xs font-bold ml-1 px-2 py-0.5 rounded-full <?= $account->getPlan() === 'Premium' ? 'bg-emerald-500/10 text-emerald-400 border border-emerald-500/20' : 'bg-slate-800 text-slate-400' ?>">
                                    <?= $account->getPlan(); ?>
                                </span>
                            </div>
                        </div>
                        <?php if ($account instanceof Premium): ?>
                            <div class="mt-4 pt-3 border-t border-slate-800 text-xs text-emerald-400/80 font-medium leading-relaxed">
                                <i class="fa fa-circle-check mr-1 text-[10px]"></i> <?= $account->getPayment(); ?>
                            </div>
                        <?php endif; ?>
                    </div>

                    
                    <div class="bg-slate-900 border border-slate-800 rounded-2xl p-5">
                        <h3 class="text-xs font-bold tracking-wider uppercase text-slate-500 mb-2">Network Broadcast Message</h3>
                        <p class="text-xs text-slate-400 leading-relaxed"><?= $account->playMessage(); ?></p>
                    </div>
                </div>

                
                <div class="md:col-span-2 space-y-4">
                    <div class="bg-slate-900 border border-slate-800 rounded-2xl p-6">
                        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3 mb-6">
                            <h3 class="text-base font-bold tracking-tight">Central Audio Repository</h3>
                            <div class="relative w-full sm:w-64">
                                <i class="fa fa-search absolute left-3.5 top-3 text-xs text-slate-500"></i>
                                <input type="text" id="search" onkeyup="filterMusic()" placeholder="Filter library metrics..." 
                                       class="w-full bg-slate-950 border border-slate-800 rounded-xl pl-9 pr-4 py-1.5 text-xs text-slate-100 focus:outline-none focus:border-emerald-500 transition-colors">
                            </div>
                        </div>

                        
                        <div class="overflow-hidden">
                            <table class="w-full text-left border-collapse" id="musicTable">
                                <thead>
                                    <tr class="border-b border-slate-800 text-slate-500 text-xs font-bold uppercase tracking-wider">
                                        <th class="pb-3 pl-2">Title</th>
                                        <th class="pb-3">Creator / Author</th>
                                        <th class="pb-3 text-right pr-2">Action Node</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-slate-800/50 text-sm">
                                    <?php foreach ($songs as $song): 
                                        $isActive = ($currentSong && $currentSong['id'] == $song['id']);
                                    ?>
                                        <tr class="group hover:bg-slate-800/30 transition-colors <?= $isActive ? 'bg-emerald-950/20 text-emerald-400' : '' ?>">
                                            <td class="py-3.5 font-semibold pl-2">
                                                <?php if($isActive): ?><i class="fa fa-volume-high text-xs mr-2 text-emerald-400 animate-pulse"></i><?php endif; ?>
                                                <?= htmlspecialchars($song['title']); ?>
                                            </td>
                                            <td class="py-3.5 text-slate-400 group-hover:text-slate-300 <?= $isActive ? 'text-emerald-300/80' : '' ?>"><?= htmlspecialchars($song['author']); ?></td>
                                            <td class="py-3.5 text-right pr-2">
                                                
                                                <a href="?play_id=<?= $song['id']; ?>" class="inline-flex items-center justify-center h-8 px-4 rounded-lg text-xs font-bold border transition-all <?= $isActive ? 'bg-emerald-500 text-slate-950 border-emerald-500 hover:bg-emerald-400' : 'bg-slate-950 text-slate-200 border-slate-800 hover:border-slate-700 hover:bg-slate-900' ?>">
                                                    <?= $isActive ? 'Playing' : 'Initialize' ?>
                                                </a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </main>

    
    <?php if ($account && $currentSong): ?>
        <footer class="sticky bottom-0 left-0 right-0 bg-slate-900 border-t border-slate-800 p-4 shadow-2xl backdrop-blur-md">
            <div class="container mx-auto max-w-4xl flex flex-col md:flex-row items-center justify-between gap-4">
                <div class="flex items-center space-x-3 w-full md:w-1/3">
                    <div class="h-10 w-10 bg-slate-800 border border-slate-700 rounded-lg flex items-center justify-center text-slate-400 text-sm shadow-inner">
                        <i class="fa fa-music text-emerald-400 animate-spin" style="animation-duration: 8s;"></i>
                    </div>
                    <div class="overflow-hidden">
                        <h4 class="text-sm font-bold truncate text-slate-100"><?= htmlspecialchars($currentSong['title']); ?></h4>
                        <p class="text-xs text-slate-400 truncate"><?= htmlspecialchars($currentSong['author']); ?></p>
                    </div>
                </div>
                
                <div class="w-full md:w-2/3 flex flex-col items-center gap-1.5">
                   
                    <audio id="player" class="w-full h-8 opacity-90 filter invert tracking-wider" controls autoplay src="<?= $currentSong['url']; ?>"></audio>
                    <?php if ($account instanceof Free): ?>
                        <span class="text-[10px] uppercase font-bold tracking-widest text-amber-500/80 animate-pulse">
                            <i class="fa fa-triangle-exclamation mr-1"></i> Next Commercial break incoming shortly
                        </span>
                    <?php endif; ?>
                </div>
            </div>
        </footer>
    <?php endif; ?>

    
    <script>
        function filterMusic() {
            let input = document.getElementById("search").value.toLowerCase();
            let rows = document.querySelectorAll("#musicTable tbody tr");
            rows.forEach((row) => {
                let text = row.innerText.toLowerCase();
                row.style.display = text.includes(input) ? "" : "none";
            });
        }
    </script>
</body>
</html>