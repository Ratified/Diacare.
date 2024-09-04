<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Health Records') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Explanation Section -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="text-lg font-semibold" style="color: #2EB4DE;">Welcome, {{ Auth::user()->name }}!</h3>
                    <p class="mb-4">This page is designed to help you track various health metrics over time. Enter your health records as obtained from your doctor to monitor trends and spot any potential issues early. The graphs below will display your data and provide insights based on your latest measurements, helping you stay on top of your health.</p>
                    <a href="{{ route('health-tracker.index') }}" class="text-blue-500 hover:text-blue-700">
                        Enter New Health Records
                    </a>
                </div>
            </div>

            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mt-8 grid grid-cols-1 sm:grid-cols-2 gap-6">
                @foreach ([
                    'bloodSugar' => 'Blood Sugar Levels', 
                    'weight' => 'Weight', 
                    'height' => 'Height', 
                    'systolicPressure' => 'Systolic Pressure', 
                    'diastolicPressure' => 'Diastolic Pressure', 
                    'cholesterol' => 'Cholesterol', 
                    'temperature' => 'Temperature', 
                    'pulse' => 'Pulse'
                ] as $chartId => $chartTitle)
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg mb-6">
                    <div class="p-6">
                        <h2 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-4" style="color: #2EB4DE;">{{ $chartTitle }}</h2>
                        <canvas id="{{ $chartId }}Chart" width="400" height="200"></canvas>
                        <div id="{{ $chartId }}Recommendations" class="mt-4 text-gray-700 dark:text-gray-300"></div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>

    <x-flash-message />

    <style>
        .warning {
            color: red;
            font-weight: bold;
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            fetch('{{ route('health-records') }}')
                .then(response => response.json())
                .then(data => {
                    const dates = data.map(record => new Date(record.lastTestedDate).toLocaleDateString());
    
                    const healthData = {
                        bloodSugar: data.map(record => ({ value: parseFloat(record.blood_sugar), date: record.lastTestedDate })),
                        weight: data.map(record => ({ value: parseFloat(record.weight), date: record.lastTestedDate })),
                        height: data.map(record => ({ value: parseFloat(record.height), date: record.lastTestedDate })),
                        systolicPressure: data.map(record => ({ value: parseFloat(record.systolic_pressure), date: record.lastTestedDate })),
                        diastolicPressure: data.map(record => ({ value: parseFloat(record.diastolic_pressure), date: record.lastTestedDate })),
                        cholesterol: data.map(record => ({ value: parseFloat(record.cholesterol), date: record.lastTestedDate })),
                        temperature: data.map(record => ({ value: parseFloat(record.temperature), date: record.lastTestedDate })),
                        pulse: data.map(record => ({ value: parseFloat(record.pulse), date: record.lastTestedDate }))
                    };
    
                    const normalRanges = {
                        bloodSugar: [4, 7],
                        weight: [50, 100], 
                        height: [140, 200],
                        systolicPressure: [90, 120],
                        diastolicPressure: [60, 80],
                        cholesterol: [3, 5],
                        temperature: [36.1, 37.2],
                        pulse: [60, 100]
                    };
    
                    function createChart(ctx, label, data, color, normalRange) {
                        const normalLower = normalRange[0] || 0;
                        const normalUpper = normalRange[1] || 0;
    
                        return new Chart(ctx, {
                            type: 'line',
                            data: {
                                labels: dates,
                                datasets: [
                                    {
                                        label: label,
                                        backgroundColor: color + '0.2)',
                                        borderColor: color + '1)',
                                        data: data.map(item => item.value),
                                        borderWidth: 2,
                                        pointBackgroundColor: data.map(item => 
                                            item.value < normalLower || item.value > normalUpper ? 'rgba(255, 99, 132, 1)' : 'rgba(54, 162, 235, 1)'
                                        ),
                                        pointBorderColor: 'rgba(0, 0, 0, 0.1)',
                                        pointBorderWidth: 2
                                    },
                                    {
                                        label: 'Normal Range (Lower)',
                                        data: Array(dates.length).fill(normalLower),
                                        borderColor: 'rgba(255, 159, 64, 0.6)',
                                        borderWidth: 1,
                                        borderDash: [5, 5],
                                        fill: false
                                    },
                                    {
                                        label: 'Normal Range (Upper)',
                                        data: Array(dates.length).fill(normalUpper),
                                        borderColor: 'rgba(75, 192, 192, 0.6)',
                                        borderWidth: 1,
                                        borderDash: [5, 5],
                                        fill: false
                                    }
                                ]
                            },
                            options: {
                                scales: {
                                    y: {
                                        beginAtZero: true,
                                        title: {
                                            display: true,
                                            text: label,
                                            font: {
                                                weight: 'bold'
                                            }
                                        }
                                    },
                                    x: {
                                        title: {
                                            display: true,
                                            text: 'Test Date',
                                            font: {
                                                weight: 'bold'
                                            }
                                        }
                                    }
                                },
                                plugins: {
                                    tooltip: {
                                        callbacks: {
                                            afterBody: (tooltipItems) => {
                                                const tooltipItem = tooltipItems[0];
                                                const date = tooltipItem.label;
                                                const value = tooltipItem.raw;
                                                const normalLower = normalRange[0] || 0;
                                                const normalUpper = normalRange[1] || 0;
                                                if (value < normalLower || value > normalUpper) {
                                                    return `Warning: On ${date}, the value was ${value}, which is outside the normal range.`;
                                                }
                                            }
                                        }
                                    }
                                }
                            }
                        });
                    }
    
                    Object.keys(healthData).forEach(key => {
                        const ctx = document.getElementById(`${key}Chart`).getContext('2d');
                        createChart(ctx, key.charAt(0).toUpperCase() + key.slice(1).replace(/([A-Z])/g, ' $1').trim(), healthData[key], 'rgba(54, 162, 235, ', normalRanges[key] || [0, 0]);
    
                        const latestRecord = healthData[key][healthData[key].length - 1];
                        const range = normalRanges[key] || [0, 0];
                        let insightText = '';
    
                        if (latestRecord.value < range[0]) {
                            insightText = `<span class="warning">Today, your ${key.replace(/([A-Z])/g, ' $1').toLowerCase()} was below the normal range. Consider consulting with your doctor.</span>`;
                        } else if (latestRecord.value > range[1]) {
                            insightText = `<span class="warning">Today, your ${key.replace(/([A-Z])/g, ' $1').toLowerCase()} was above the normal range. It is advisable to consult with your doctor.</span>`;
                        } else {
                            insightText = `Congratulations! Your ${key.replace(/([A-Z])/g, ' $1').toLowerCase()} is within the normal range.`;
                        }
    
                        document.getElementById(`${key}Recommendations`).innerHTML = `<strong>Latest Measurement:</strong> ${latestRecord.value} ${latestRecord.date} <br> <strong>Insight:</strong> ${insightText}`;
                    });
                });
        });
    </script>
</x-app-layout>