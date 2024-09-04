<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Health Goals') }}
            </h2>
            <div class="flex items-center">
                <div class="relative flex items-center">
                    @php
                        $totalGoals = count($healthGoals);
                        $achievedGoals = $healthGoals->where('achieved', true)->count();
                        $percentage = $totalGoals > 0 ? round(($achievedGoals / $totalGoals) * 100) : 0;
                        $color = '';
                        $message = '';
                        switch (true) {
                            case $percentage >= 80:
                                $color = 'bg-green-500';
                                $message = 'Complete';
                                break;
                            case $percentage >= 60:
                                $color = 'bg-yellow-500';
                                $message = 'Almost There';
                                break;
                            case $percentage >= 40:
                                $color = 'bg-orange-500';
                                $message = 'Keep Going';
                                break;
                            case $percentage >= 20:
                                $color = 'bg-red-500';
                                $message = 'Let\'s Get To Work';
                                break;
                            default:
                                $color = 'bg-gray-500';
                                $message = 'Start Setting Goals';
                                break;
                        }
                    @endphp
                    <div class="w-12 h-12 rounded-full flex items-center justify-center text-white text-xl {{ $color }} percentage-circle">
                        {{ $percentage }}%
                    </div>
                    <div class="ml-4 text-gray-900 dark:text-gray-100 text-lg">
                        {{ $message }}
                    </div>
                </div>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="text-2xl font-semibold mb-4" style="color: #0056b3;">
                        Welcome to Your Health Goals Dashboard, {{ Auth::user()->name }}!
                    </h3>
                    <p class="mb-6">
                        Setting health goals is a vital part of managing your diabetes and overall well-being. By defining clear, actionable objectives, you can stay motivated and track your progress over time. Diacare is here to help you establish and achieve these goals with ease. Use the link below to set new health goals and manage existing ones.
                    </p>
                </div>
            </div>

            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="flex justify-between items-center mb-4">
                        <h4 class="text-lg font-semibold">Set New Health Goals</h4>
                        <a href="{{ route('health-goals.showCreate') }}" class="text-blue-500 hover:text-blue-700">
                            Create New Goal
                        </a>
                    </div>
                    <p class="text-sm text-gray-600 dark:text-gray-300">
                        Below are your current health goals. Keep track of your progress and make adjustments as needed.
                    </p>
                </div>
            </div>

            @foreach ($healthGoals as $goal)
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6">
                    <div class="flex justify-between items-center mb-4">
                        <h2 class="text-lg font-semibold text-gray-900 dark:text-gray-100">{{ $goal->title }}</h2>
                        <input type="checkbox" class="form-checkbox h-6 w-6 text-green-500" 
                               data-goal-id="{{ $goal->id }}"
                               onchange="handleCheckboxChange(this)">
                    </div>
                    <p class="text-gray-700 dark:text-gray-300 mb-4">{{ $goal->description }}</p>
                    <div class="flex justify-between items-center">
                        <div>
                            <p class="text-sm text-gray-600 dark:text-gray-300">
                                Created on: {{ $goal->created_at->format('M d, Y') }}
                            </p>
                            <p class="text-sm text-gray-600 dark:text-gray-300">
                                Target Date: {{ \Carbon\Carbon::parse($goal->target_date)->format('M d, Y') }}
                            </p>
                        </div>
                        <div class="flex space-x-4">
                            <a href="{{ route('health-goals.edit', $goal->id) }}" class="text-blue-500 hover:text-blue-700">
                                Edit Goal
                            </a>
                            <form action="{{ route('health-goals.destroy', $goal->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this goal?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500 hover:text-red-700">Delete Goal</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    <x-flash-message />
</x-app-layout>

<script>
document.addEventListener('DOMContentLoaded', () => {
    const checkboxes = document.querySelectorAll('input[type="checkbox"]');
    
    // Load saved checkbox states
    checkboxes.forEach(checkbox => {
        const isChecked = localStorage.getItem(`goal-${checkbox.dataset.goalId}`) === 'true';
        checkbox.checked = isChecked;
    });

    // Update the percentage on page load
    updatePercentage();

    // Add event listener to checkboxes
    checkboxes.forEach(checkbox => {
        checkbox.addEventListener('change', (event) => {
            const isChecked = event.target.checked;
            localStorage.setItem(`goal-${event.target.dataset.goalId}`, isChecked);
            updatePercentage();
            if (isChecked) {
                // Ensure alert is only shown once
                if (!event.target.dataset.alertShown) {
                    setTimeout(() => alert('Congratulations on achieving your goal!'), 100);
                    event.target.dataset.alertShown = true;
                }
            }
        });
    });
});

function handleCheckboxChange(checkbox) {
    const isChecked = checkbox.checked;
    localStorage.setItem(`goal-${checkbox.dataset.goalId}`, isChecked);
    updatePercentage();
    if (isChecked) {
        // Ensure alert is only shown once
        if (!checkbox.dataset.alertShown) {
            setTimeout(() => alert('Congratulations on achieving your goal!'), 100);
            checkbox.dataset.alertShown = true;
        }
    }
}

function updatePercentage() {
    const checkboxes = document.querySelectorAll('input[type="checkbox"]');
    const totalGoals = checkboxes.length;
    const achievedGoals = Array.from(checkboxes).filter(cb => cb.checked).length;
    const percentage = totalGoals > 0 ? Math.round((achievedGoals / totalGoals) * 100) : 0;

    let color = '';
    let message = '';
    switch (true) {
        case percentage >= 80:
            color = 'bg-green-500';
            message = 'Complete';
            break;
        case percentage >= 60:
            color = 'bg-yellow-500';
            message = 'Almost There';
            break;
        case percentage >= 40:
            color = 'bg-orange-500';
            message = 'Keep Going';
            break;
        case percentage >= 20:
            color = 'bg-red-500';
            message = 'Let\'s Get To Work';
            break;
        default:
            color = 'bg-gray-500';
            message = 'Start Setting Goals';
            break;
    }

    const percentageCircle = document.querySelector('.percentage-circle');
    if (percentageCircle) {
        percentageCircle.textContent = `${percentage}%`;
        percentageCircle.className = `w-12 h-12 rounded-full flex items-center justify-center text-white text-xl ${color} percentage-circle`;
        const messageContainer = percentageCircle.nextElementSibling;
        if (messageContainer) {
            messageContainer.textContent = message;
            messageContainer.className = `ml-4 text-gray-900 dark:text-gray-100 text-lg ${color}`;
        }
    }
}
</script>