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
    <div class="container">
        <div class="min-h-screen py-8">
            <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="bg-white rounded-lg shadow-sm border border-zinc-200 overflow-hidden">
                    {{-- Header --}}
                    <div class="bg-white p-6 border-b border-zinc-200">
                        <h1 class="text-3xl font-bold text-zinc-900">球員詳細資料</h1>
                    </div>

                    <div class="p-6 lg:p-8">
                        {{-- Player Header --}}
                        <div class="grid lg:grid-cols-3 gap-8 mb-8">
                            {{-- Player Image --}}
                            <div class="lg:col-span-1">
                                <div class="relative aspect-[3/4] overflow-hidden rounded-lg bg-gradient-to-b from-zinc-100 to-zinc-200">
                                    <img 
                                        src="{{ $player['image'] }}" 
                                        alt="{{ $player['name'] }}"
                                        class="w-full h-full object-cover"
                                    />
                                    <div class="absolute top-4 right-4">
                                        <span class="inline-flex items-center px-4 py-2 rounded-md bg-white/90 text-zinc-900 text-2xl font-semibold">
                                            #{{ $player['number'] }}
                                        </span>
                                    </div>
                                </div>
                            </div>

                            {{-- Player Info --}}
                            <div class="lg:col-span-2 space-y-6">
                                <div>
                                    <h2 class="text-4xl font-bold text-zinc-900 mb-2">{{ $player['name'] }}</h2>
                                    <p class="text-xl text-zinc-500 mb-4">{{ $player['nameEn'] }}</p>
                                    <div class="flex gap-2">
                                        <span class="inline-flex items-center px-3 py-1 rounded-md bg-zinc-900 text-white text-base">
                                            {{ $player['position'] }}
                                        </span>
                                        @if(!empty($player['guilds']) && count($player['guilds']) > 0)

                                            @foreach($player['guilds'] as $guild)
                                                <span class="inline-flex items-center px-3 py-1 rounded-md bg-zinc-100 text-zinc-900 text-base">
                                                    {{ $guild->name }}
                                                </span>
                                            @endforeach

                                        @else
                                            <span class="inline-flex items-center px-3 py-1 rounded-md bg-zinc-100 text-zinc-900 text-base">
                                                尚未加入任何公會
                                            </span>                                        
                                            
                                        @endif

                                    </div>
                                </div>

                                <hr class="border-zinc-200">

                                {{-- Basic Info Grid --}}
                                <div class="grid grid-cols-2 gap-4">
                                    <div>
                                        <div class="text-sm text-zinc-500 mb-1">國籍</div>
                                        <div class="font-semibold text-lg text-zinc-900">{{ $player['nationality'] }}</div>
                                    </div>
                                    <div>
                                        <div class="text-sm text-zinc-500 mb-1">年齡</div>
                                        <div class="font-semibold text-lg text-zinc-900">{{ $player['age'] }} 歲</div>
                                    </div>
                                </div>

                                <hr class="border-zinc-200">

                                {{-- Stats Grid --}}
                                <div class="grid grid-cols-4 gap-4 p-4 bg-zinc-50 rounded-lg">
                                    <div class="text-center">
                                        <div class="text-3xl font-bold text-zinc-900 mb-1">{{ $player['stats']['matches'] }}</div>
                                        <div class="text-sm text-zinc-500">參加場次</div>
                                    </div>
                                    <div class="text-center">
                                        <div class="text-3xl font-bold text-zinc-900 mb-1">{{ $player['stats']['FreeSum'] }}</div>
                                        <div class="text-sm text-zinc-500">簽到次書</div>
                                    </div>
                                    <div class="text-center">
                                        <div class="text-3xl font-bold text-zinc-900 mb-1">{{ $player['stats']['goals'] }}</div>
                                        <div class="text-sm text-zinc-500">進球</div>
                                    </div>
                                    <div class="text-center">
                                        <div class="text-3xl font-bold text-zinc-900 mb-1">{{ $player['stats']['assists'] }}</div>
                                        <div class="text-sm text-zinc-500">助攻</div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Tabs Section with Alpine.js --}}
                        <div x-data="{ activeTab: 'overview' }">
                            {{-- Tab Navigation --}}
                            <div class="flex border-b border-zinc-200">
                                <button 
                                    @click="activeTab = 'overview'"
                                    :class="activeTab === 'overview' ? 'border-zinc-900 text-zinc-900' : 'border-transparent text-zinc-500 hover:text-zinc-700 hover:border-zinc-300'"
                                    class="flex-1 py-3 px-4 text-center border-b-2 font-medium transition-colors"
                                >
                                    綜合資訊
                                </button>
                                <button 
                                    @click="activeTab = 'stats'"
                                    :class="activeTab === 'stats' ? 'border-zinc-900 text-zinc-900' : 'border-transparent text-zinc-500 hover:text-zinc-700 hover:border-zinc-300'"
                                    class="flex-1 py-3 px-4 text-center border-b-2 font-medium transition-colors"
                                >
                                    詳細數據
                                </button>
                                <button 
                                    @click="activeTab = 'career'"
                                    :class="activeTab === 'career' ? 'border-zinc-900 text-zinc-900' : 'border-transparent text-zinc-500 hover:text-zinc-700 hover:border-zinc-300'"
                                    class="flex-1 py-3 px-4 text-center border-b-2 font-medium transition-colors"
                                >
                                    職業生涯
                                </button>
                            </div>

                            {{-- Tab Content: Overview --}}
                            <div x-show="activeTab === 'overview'" x-cloak class="space-y-4 mt-6">
                                <div class="bg-white border border-zinc-200 rounded-lg shadow-sm p-6">
                                    <h3 class="font-semibold text-lg text-zinc-900 mb-4">球員簡介</h3>
                                    <p class="text-zinc-600 leading-relaxed">
                                        {{ $player['name'] }}是一位出色的{{ $player['position'] }}球員，目前效力於{{ $player['team'] }}。
                                        以其出色的技術和戰術意識著稱，在場上展現出色的表現。
                                        本賽季共出場{{ $player['stats']['matches'] }}次，貢獻{{ $player['stats']['goals'] }}個進球和
                                        {{ $player['stats']['assists'] }}次助攻。
                                    </p>
                                </div>

                                <!-- <div class="bg-white border border-zinc-200 rounded-lg shadow-sm p-6">
                                    <h3 class="font-semibold text-lg text-zinc-900 mb-4">特點與優勢</h3>
                                    <ul class="space-y-2 text-zinc-600">
                                        <li class="flex items-start gap-2">
                                            <span class="text-green-600 mt-1">●</span>
                                            <span>出色的技術能力和球場視野</span>
                                        </li>
                                        <li class="flex items-start gap-2">
                                            <span class="text-green-600 mt-1">●</span>
                                            <span>強大的身體素質和對抗能力</span>
                                        </li>
                                        <li class="flex items-start gap-2">
                                            <span class="text-green-600 mt-1">●</span>
                                            <span>良好的團隊合作精神</span>
                                        </li>
                                        <li class="flex items-start gap-2">
                                            <span class="text-green-600 mt-1">●</span>
                                            <span>關鍵時刻的穩定表現</span>
                                        </li>
                                    </ul>
                                </div> -->
                            </div>

                            {{-- Tab Content: Stats --}}
                            <div x-show="activeTab === 'stats'" x-cloak class="space-y-4 mt-6">
                                <div class="bg-white border border-zinc-200 rounded-lg shadow-sm p-6">
                                    <h3 class="font-semibold text-lg text-zinc-900 mb-4">本賽季數據</h3>
                                    <div class="space-y-4">
                                        <div class="flex justify-between items-center">
                                            <span class="text-zinc-600">出場次數</span>
                                            <span class="font-semibold text-zinc-900">{{ $player['stats']['matches'] }} 場</span>
                                        </div>
                                        <hr class="border-zinc-200">
                                        <div class="flex justify-between items-center">
                                            <span class="text-zinc-600">簽到次數</span>
                                            <span class="font-semibold text-zinc-900">{{ $player['stats']['FreeSum'] }} 場</span>
                                        </div>
                                        <hr class="border-zinc-200">
                                        <div class="flex justify-between items-center">
                                            <span class="text-zinc-600">進球數</span>
                                            <span class="font-semibold text-zinc-900">{{ $player['stats']['assists'] }} 球</span>
                                        </div>
                                        <hr class="border-zinc-200">
                                        <div class="flex justify-between items-center">
                                            <span class="text-zinc-600">助攻數</span>
                                            <span class="font-semibold text-zinc-900">{{ $player['stats']['assists'] }} 次</span>
                                        </div>
                                        <!-- <hr class="border-zinc-200">
                                        <div class="flex justify-between items-center">
                                            <span class="text-zinc-600">射門次數</span>
                                            <span class="font-semibold text-zinc-900">{{ $player['stats']['goals'] * 4 }} 次</span>
                                        </div>
                                        <hr class="border-zinc-200">
                                        <div class="flex justify-between items-center">
                                            <span class="text-zinc-600">傳球成功率</span>
                                            <span class="font-semibold text-zinc-900">87%</span>
                                        </div> -->
                                    </div>
                                </div>
                            </div>

                            {{-- Tab Content: Career --}}
                            <div x-show="activeTab === 'career'" x-cloak class="space-y-4 mt-6">
                                <div class="bg-white border border-zinc-200 rounded-lg shadow-sm p-6">
                                    <h3 class="font-semibold text-lg text-zinc-900 mb-4">公會列表</h3>

                                    <div class="space-y-6">
                                        @if(!empty($player['guilds']) && count($player['guilds']) > 0)

                                            @foreach($player['guilds'] as $guild)
                                                <div class="flex gap-4">
                                                    <div class="w-24 text-sm text-zinc-500 font-semibold">{{ $guild->created_at ?? '無資料' }}</div>
                                                    <div class="flex-1">
                                                        <div class="font-semibold text-zinc-900 mb-1">{{ $guild->name }}</div>
                                                        <span class="inline-flex items-center px-2 py-1 rounded-md border border-zinc-300 text-sm">{{ $guild->number ?? '' }} </span>
                                                    </div>

                                                </div>
                                            @endforeach

                                        @else
                                            <p>尚未加入任何公會</p>
                                        @endif
                                        <!-- <div class="flex gap-4">
                                            <div class="w-24 text-sm text-zinc-500 font-semibold">2021-現在</div>
                                            <div class="flex-1">
                                                <div class="font-semibold text-zinc-900 mb-1">{{ $player['team'] }}</div>
                                                <p class="text-sm text-zinc-600">
                                                    加入球隊後迅速成為主力陣容，展現出色的表現和領導能力。
                                                </p>
                                            </div>
                                        </div>
                                        <hr class="border-zinc-200">
                                        <div class="flex gap-4">
                                            <div class="w-24 text-sm text-zinc-500 font-semibold">2018-2021</div>
                                            <div class="flex-1">
                                                <div class="font-semibold text-zinc-900 mb-1">青年隊</div>
                                                <p class="text-sm text-zinc-600">
                                                    在青年隊訓練期間展現出眾的天賦，獲得多個獎項與認可。
                                                </p>
                                            </div>
                                        </div>
                                        <hr class="border-zinc-200">
                                        <div class="flex gap-4">
                                            <div class="w-24 text-sm text-zinc-500 font-semibold">2015-2018</div>
                                            <div class="flex-1">
                                                <div class="font-semibold text-zinc-900 mb-1">學院訓練</div>
                                                <p class="text-sm text-zinc-600">
                                                    接受系統性的專業訓練，建立堅實的技術基礎。
                                                </p>
                                            </div>
                                        </div> -->
                                    </div>
                                </div>

                                <!-- <div class="bg-white border border-zinc-200 rounded-lg shadow-sm p-6">
                                    <h3 class="font-semibold text-lg text-zinc-900 mb-4">榮譽與獎項</h3>
                                    <ul class="space-y-3 text-zinc-600">
                                        <li class="flex items-center gap-3">
                                            <span class="inline-flex items-center px-2 py-1 rounded-md border border-zinc-300 text-sm">2024</span>
                                            <span>最佳陣容入選</span>
                                        </li>
                                        <li class="flex items-center gap-3">
                                            <span class="inline-flex items-center px-2 py-1 rounded-md border border-zinc-300 text-sm">2023</span>
                                            <span>月度最佳球員</span>
                                        </li>
                                        <li class="flex items-center gap-3">
                                            <span class="inline-flex items-center px-2 py-1 rounded-md border border-zinc-300 text-sm">2022</span>
                                            <span>年度最佳新秀</span>
                                        </li>
                                    </ul>
                                </div> -->
                            </div>
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