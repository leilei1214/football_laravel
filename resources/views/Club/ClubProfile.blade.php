@extends('layouts.app')

@section('title', '球員資料')
@section('style')

<link rel="stylesheet" href="https://cdn.datatables.net/1.13.8/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"/>

<link rel="stylesheet" href="{{ asset('css/event/style.css') }}">

<link rel="stylesheet" href="{{ asset('css/Manager.css') }}">
<script src="https://cdn.tailwindcss.com"></script>
<script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

<style>
[x-cloak] { display: none !important; }
.product-header .badge {
    position: relative;
    font-size: 20px;
    padding: 10px;
}

</style>
@endsection


@section('content')
<section class="section section-md bg-gray-100">
    
    <div class="min-h-screen">
        {{-- Cover Image --}}
        <div class="relative h-64 lg:h-80 overflow-hidden bg-gradient-to-b from-zinc-900 to-zinc-700">
            <img 
                src="{{ $team['coverImage'] }}" 
                alt="{{ $team['name'] }}"
                class="w-full h-full object-cover opacity-60"
            />
            <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
        </div>

        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 -mt-24 relative z-10">
            {{-- Team Header Card --}}
            <div class="bg-white rounded-lg shadow-sm border border-zinc-200 p-6 lg:p-8 mb-8">
                <div class="flex flex-col md:flex-row gap-6 items-start md:items-center">
                    {{-- Team Logo --}}
                    <div class="w-32 h-32 rounded-full overflow-hidden bg-white shadow-lg border-4 border-white flex-shrink-0">
                        <img 
                            src="{{ $team['logo'] }}" 
                            alt="{{ $team['name'] }}"
                            class="w-full h-full object-cover"
                        />
                    </div>

                    {{-- Team Info --}}
                    <div class="flex-1">
                        <h1 class="text-4xl font-bold text-zinc-900 mb-2">{{ $team['name'] }}</h1>
                        <p class="text-xl text-zinc-500 mb-4">{{ $team['nameEn'] }}</p>
                        <div class="flex flex-wrap gap-2 mb-4">
                            <span class="inline-flex items-center px-3 py-1 rounded-md bg-zinc-900 text-white text-sm">
                                {{ $team['league'] }}
                            </span>
                            <span class="inline-flex items-center px-3 py-1 rounded-md bg-zinc-100 text-zinc-900 text-sm">
                                {{ implode(' / ', $team['colors']) }}
                            </span>
                        </div>
                        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 text-sm">
                            <div class="flex items-center gap-2 text-zinc-600">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                                <span>成立於 {{ $team['founded'] }}</span>
                            </div>
                            <div class="flex items-center gap-2 text-zinc-600">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                                <span>{{ $team['stadium'] }}</span>
                            </div>
                            <div class="flex items-center gap-2 text-zinc-600">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                </svg>
                                <span>容納 {{ $team['capacity'] }} 人</span>
                            </div>
                            <div class="flex items-center gap-2 text-zinc-600">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"></path>
                                </svg>
                                <span>{{ count($team['achievements']) }} 項榮譽</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Stats Overview --}}
            @php
                $winRate = number_format(($team['stats']['wins'] / $team['stats']['matches']) * 100, 1);
            @endphp
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-8">
                <div class="bg-white rounded-lg shadow-sm border border-zinc-200 p-6 text-center">
                    <div class="text-3xl font-bold text-zinc-900 mb-1">{{ $team['stats']['points'] }}</div>
                    <div class="text-sm text-zinc-500">積分</div>
                </div>
                <div class="bg-white rounded-lg shadow-sm border border-zinc-200 p-6 text-center">
                    <div class="text-3xl font-bold text-green-600 mb-1">{{ $team['stats']['wins'] }}</div>
                    <div class="text-sm text-zinc-500">勝場</div>
                </div>
                <div class="bg-white rounded-lg shadow-sm border border-zinc-200 p-6 text-center">
                    <div class="text-3xl font-bold text-zinc-900 mb-1">{{ $winRate }}%</div>
                    <div class="text-sm text-zinc-500">勝率</div>
                </div>
                <div class="bg-white rounded-lg shadow-sm border border-zinc-200 p-6 text-center">
                    <div class="text-3xl font-bold text-blue-600 mb-1">{{ $team['stats']['goalsFor'] }}</div>
                    <div class="text-sm text-zinc-500">進球數</div>
                </div>
            </div>

            {{-- Tabs Section --}}
            <div x-data="{ activeTab: 'overview' }" class="mb-8">
                {{-- Tab Navigation --}}
                <div class="flex border-b border-zinc-200 mb-6">
                    <button 
                        @click="activeTab = 'overview'"
                        :class="activeTab === 'overview' ? 'border-zinc-900 text-zinc-900' : 'border-transparent text-zinc-500 hover:text-zinc-700 hover:border-zinc-300'"
                        class="flex-1 py-3 px-4 text-center border-b-2 font-medium transition-colors"
                    >
                        球隊概況
                    </button>
                    <button 
                        @click="activeTab = 'squad'"
                        :class="activeTab === 'squad' ? 'border-zinc-900 text-zinc-900' : 'border-transparent text-zinc-500 hover:text-zinc-700 hover:border-zinc-300'"
                        class="flex-1 py-3 px-4 text-center border-b-2 font-medium transition-colors"
                    >
                        球員陣容
                    </button>
                    <button 
                        @click="activeTab = 'stats'"
                        :class="activeTab === 'stats' ? 'border-zinc-900 text-zinc-900' : 'border-transparent text-zinc-500 hover:text-zinc-700 hover:border-zinc-300'"
                        class="flex-1 py-3 px-4 text-center border-b-2 font-medium transition-colors"
                    >
                        賽季數據
                    </button>
                    <button 
                        @click="activeTab = 'achievements'"
                        :class="activeTab === 'achievements' ? 'border-zinc-900 text-zinc-900' : 'border-transparent text-zinc-500 hover:text-zinc-700 hover:border-zinc-300'"
                        class="flex-1 py-3 px-4 text-center border-b-2 font-medium transition-colors"
                    >
                        歷史榮譽
                    </button>
                </div>

                {{-- Overview Tab --}}
                <div x-show="activeTab === 'overview'" x-cloak class="space-y-4">
                    <div class="bg-white rounded-lg shadow-sm border border-zinc-200 p-6">
                        <h3 class="font-semibold text-lg text-zinc-900 mb-4">球隊簡介</h3>
                        <p class="text-zinc-600 leading-relaxed mb-4">
                            {{ $team['name'] }}成立於{{ $team['founded'] }}年，是{{ $team['league'] }}的一支強勁球隊。
                            球隊以其進攻型戰術和團隊精神聞名，主場設在{{ $team['stadium'] }}，可容納{{ $team['capacity'] }}名觀眾。
                        </p>
                        <p class="text-zinc-600 leading-relaxed">
                            在教練{{ $team['manager'] }}的帶領下，球隊本賽季表現出色，目前以{{ $team['stats']['points'] }}分位居聯賽前列。
                            球隊以{{ implode('和', $team['colors']) }}為主色調，象徵著力量與榮耀。
                        </p>
                    </div>

                    <div class="bg-white rounded-lg shadow-sm border border-zinc-200 p-6">
                        <h3 class="font-semibold text-lg text-zinc-900 mb-4">球隊特色</h3>
                        <div class="grid md:grid-cols-2 gap-4">
                            <div>
                                <h4 class="font-semibold text-zinc-900 mb-2">進攻風格</h4>
                                <p class="text-sm text-zinc-600">
                                    以快速反擊和流暢的傳球配合著稱，注重控球和創造機會。
                                </p>
                            </div>
                            <div>
                                <h4 class="font-semibold text-zinc-900 mb-2">防守策略</h4>
                                <p class="text-sm text-zinc-600">
                                    採用高位壓迫戰術，強調整體防守和快速回防。
                                </p>
                            </div>
                            <div>
                                <h4 class="font-semibold text-zinc-900 mb-2">青訓系統</h4>
                                <p class="text-sm text-zinc-600">
                                    擁有完善的青訓體系，持續培養優秀的年輕球員。
                                </p>
                            </div>
                            <div>
                                <h4 class="font-semibold text-zinc-900 mb-2">球迷文化</h4>
                                <p class="text-sm text-zinc-600">
                                    擁有熱情的球迷群體，主場氣氛熱烈，為球隊提供強大支持。
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Squad Tab --}}
                <div x-show="activeTab === 'squad'" x-cloak>
                    <div class="bg-white rounded-lg shadow-sm border border-zinc-200 p-6">
                        <h3 class="font-semibold text-lg text-zinc-900 mb-6">主力陣容</h3>
                        <div class="grid md:grid-cols-2 gap-4">
                            @foreach($team['players'] as $player)
                            <div class="flex items-center gap-4 p-4 rounded-lg border border-zinc-200 hover:border-zinc-300 transition-colors">
                                <div class="w-16 h-16 rounded-full overflow-hidden bg-zinc-100 flex-shrink-0">
                                    <img 
                                        src="{{ $player['image'] }}" 
                                        alt="{{ $player['name'] }}"
                                        class="w-full h-full object-cover"
                                    />
                                </div>
                                <div class="flex-1">
                                    <div class="font-semibold text-zinc-900">{{ $player['name'] }}</div>
                                    <div class="text-sm text-zinc-500">{{ $player['position'] }}</div>
                                </div>
                                <span class="inline-flex items-center px-2 py-1 rounded-md border border-zinc-300 text-sm font-semibold">
                                    #{{ $player['number'] }}
                                </span>
                            </div>
                            @endforeach
                        </div>

                        <hr class="border-zinc-200 my-6">

                        <div>
                            <h4 class="font-semibold text-zinc-900 mb-3">教練團隊</h4>
                            <div class="flex items-center gap-4 p-4 rounded-lg bg-zinc-50">
                                <div class="w-12 h-12 rounded-full bg-zinc-200 flex items-center justify-center flex-shrink-0">
                                    <svg class="w-6 h-6 text-zinc-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                    </svg>
                                </div>
                                <div>
                                    <div class="font-semibold text-zinc-900">{{ $team['manager'] }}</div>
                                    <div class="text-sm text-zinc-500">總教練</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Stats Tab --}}
                <div x-show="activeTab === 'stats'" x-cloak>
                    <div class="bg-white rounded-lg shadow-sm border border-zinc-200 p-6">
                        <h3 class="font-semibold text-lg text-zinc-900 mb-6">本賽季數據統計</h3>
                        <div class="space-y-4">
                            <div class="flex justify-between items-center">
                                <span class="text-zinc-600">比賽場次</span>
                                <span class="font-semibold text-zinc-900">{{ $team['stats']['matches'] }} 場</span>
                            </div>
                            <hr class="border-zinc-200">
                            <div class="flex justify-between items-center">
                                <span class="text-zinc-600">勝場</span>
                                <span class="font-semibold text-green-600">{{ $team['stats']['wins'] }} 場</span>
                            </div>
                            <hr class="border-zinc-200">
                            <div class="flex justify-between items-center">
                                <span class="text-zinc-600">平局</span>
                                <span class="font-semibold text-zinc-900">{{ $team['stats']['draws'] }} 場</span>
                            </div>
                            <hr class="border-zinc-200">
                            <div class="flex justify-between items-center">
                                <span class="text-zinc-600">敗場</span>
                                <span class="font-semibold text-red-600">{{ $team['stats']['losses'] }} 場</span>
                            </div>
                            <hr class="border-zinc-200">
                            <div class="flex justify-between items-center">
                                <span class="text-zinc-600">進球數</span>
                                <span class="font-semibold text-zinc-900">{{ $team['stats']['goalsFor'] }} 球</span>
                            </div>
                            <hr class="border-zinc-200">
                            <div class="flex justify-between items-center">
                                <span class="text-zinc-600">失球數</span>
                                <span class="font-semibold text-zinc-900">{{ $team['stats']['goalsAgainst'] }} 球</span>
                            </div>
                            <hr class="border-zinc-200">
                            <div class="flex justify-between items-center">
                                <span class="text-zinc-600">淨勝球</span>
                                <span class="font-semibold text-zinc-900">+{{ $team['stats']['goalsFor'] - $team['stats']['goalsAgainst'] }} 球</span>
                            </div>
                            <hr class="border-zinc-200">
                            <div class="flex justify-between items-center">
                                <span class="text-zinc-600">總積分</span>
                                <span class="font-semibold text-blue-600 text-lg">{{ $team['stats']['points'] }} 分</span>
                            </div>
                        </div>

                        @php
                            $avgGoalsFor = number_format($team['stats']['goalsFor'] / $team['stats']['matches'], 1);
                            $avgGoalsAgainst = number_format($team['stats']['goalsAgainst'] / $team['stats']['matches'], 1);
                        @endphp

                        <div class="mt-6 p-4 bg-blue-50 rounded-lg">
                            <div class="flex items-center gap-2 mb-2">
                                <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"></path>
                                </svg>
                                <span class="font-semibold text-blue-900">賽季表現</span>
                            </div>
                            <p class="text-sm text-blue-800">
                                球隊本賽季表現穩定，勝率達到 {{ $winRate }}%，展現出強大的競爭力。
                                場均進球 {{ $avgGoalsFor }} 個，場均失球 {{ $avgGoalsAgainst }} 個。
                            </p>
                        </div>
                    </div>
                </div>

                {{-- Achievements Tab --}}
                <div x-show="activeTab === 'achievements'" x-cloak>
                    <div class="bg-white rounded-lg shadow-sm border border-zinc-200 p-6">
                        <h3 class="font-semibold text-lg text-zinc-900 mb-6">歷年榮譽</h3>
                        <div class="space-y-4">
                            @foreach($team['achievements'] as $achievement)
                            <div class="flex items-center gap-4 p-4 rounded-lg bg-zinc-50">
                                <div class="w-12 h-12 rounded-full bg-amber-100 flex items-center justify-center flex-shrink-0">
                                    <svg class="w-6 h-6 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"></path>
                                    </svg>
                                </div>
                                <div class="flex-1">
                                    <div class="font-semibold text-zinc-900">{{ $achievement['title'] }}</div>
                                    <div class="text-sm text-zinc-500">{{ $achievement['year'] }} 年</div>
                                </div>
                            </div>
                            @endforeach
                        </div>

                        <hr class="border-zinc-200 my-6">

                        <div>
                            <h4 class="font-semibold text-zinc-900 mb-3">球隊記錄</h4>
                            <ul class="space-y-2 text-sm text-zinc-600">
                                <li class="flex items-start gap-2">
                                    <span class="text-blue-600 mt-1">●</span>
                                    <span>單季最多進球：62 球 (2023)</span>
                                </li>
                                <li class="flex items-start gap-2">
                                    <span class="text-blue-600 mt-1">●</span>
                                    <span>單季最少失球：24 球 (2024)</span>
                                </li>
                                <li class="flex items-start gap-2">
                                    <span class="text-blue-600 mt-1">●</span>
                                    <span>最長不敗紀錄：15 場 (2023)</span>
                                </li>
                                <li class="flex items-start gap-2">
                                    <span class="text-blue-600 mt-1">●</span>
                                    <span>最大比分勝利：7-0 (2022)</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
@section('scripts')

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src = "https://cdn.datatables.net/1.13.8/js/jquery.dataTables.min.js" ></script>


@endsection