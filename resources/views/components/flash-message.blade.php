@if(session()->has('message'))
    <div 
        x-data="{show: true}" 
        x-init="setTimeout(() => show = false, 3000)" 
        x-show="show"  
        class="fixed top-0 left-1/2 transform -translate-x-1/2 bg-[#0056b3] text-white px-48 py-3 rounded-lg shadow-lg"
    >
        <p>
            {{ session('message') }}
        </p>
    </div>
@endif

@if(session()->has('error'))
    <div 
        x-data="{show: true}" 
        x-init="setTimeout(() => show = false, 3000)" 
        x-show="show"  
        class="fixed top-0 left-1/2 transform -translate-x-1/2 bg-red-600 text-white px-48 py-3 rounded-lg shadow-lg"
    >
        <p>
            {{ session('error') }}
        </p>
    </div>
@endif