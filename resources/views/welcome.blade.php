<x-app-layout>
    <div class="text-center p-5 bg-gray-900 rounded-b">
        <h1 class="font-bold text-4xl text-white">Welcome to Failfish.com</h1>
        <h2 class="text-gray-400 text-xl font-semibold">The official host of all things failfish.</h2>
    </div>

    <div class="max-w-5xl mx-auto">

        <div class="bg-white p-5 mx-auto max-w-5xl mt-10 rounded shadow-lg">
            <h3 class="text-center font-bold text-4xl py-2">Austin of The Day</h3>
            <img class="object-contain max-h-screen rounded-2xl mx-auto" src="{{asset('/img/'.$daily->name.'.png')}}"/>
        </div>
        <inc></inc>
        <div class="mt-10 mx-auto">
            <h1 class="bg-gray-900 rounded-t text-white text-center font-bold text-4xl py-2">
                What is Failfish.com?
            </h1>
            <div class="bg-white rounded-b p-3">
                <p>
                Failfish is a catalog of the most FAIL people on the internet, all centralized into one convenient site.
                You can find the BIGGEST FAILS here. VIRALHOG? VINE? These websites SUCK for looking at FAILS!  FACEBOOK LIVE?
                WHY WOULD YOU GO TO FAILBOOK LIVE WHEN YOU COULD BE ON FAILFISH.COM!
                </p>
                <span class="text-xs text-gray-400">failfish live coming 2021 <span class="text-gray-100 text-2xs"> (maybe)</span></span>
            </div>
        </div>
    </div>
</x-app-layout>
