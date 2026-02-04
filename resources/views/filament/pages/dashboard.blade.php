<x-filament-panels::page>
    {{-- Tailwind CDN --}}
    <script src="https://cdn.tailwindcss.com"></script>

    {{-- Custom CSS for Select dropdowns --}}
    <style>
        /* Select box balandligini oshirish va textni to'g'rilash */
        .fi-fo-select .fi-input-wrp,
        .fi-fo-select input,
        .fi-fo-select .fi-select-input {
            min-height: 48px !important;
            padding: 0.75rem 1rem !important;
        }

        .fi-fo-select button[type="button"] {
            min-height: 48px !important;
            padding: 0.75rem 2.5rem 0.75rem 1rem !important;
        }

        /* Input wrapper */
        .fi-input-wrp {
            min-height: 48px !important;
        }

        /* Select trigger text */
        .fi-fo-select .fi-select-trigger,
        .fi-fo-select [class*="trigger"] {
            padding: 0.75rem 1rem !important;
            display: flex !important;
            align-items: center !important;
        }

        /* Selected value text */
        .fi-fo-select .fi-select-trigger span,
        .fi-fo-select button span {
            padding-left: 0 !important;
            margin-left: 0 !important;
        }

        /* Placeholder va selected text */
        .fi-input {
            padding: 0.75rem 1rem !important;
        }

        /* Dropdown panel dark mode */
        .fi-fo-select .choices__list--dropdown,
        .fi-fo-select .choices__list[aria-expanded] {
            background-color: rgb(31, 41, 55) !important;
            border-color: rgb(55, 65, 81) !important;
        }

        .fi-fo-select .choices__item--selectable {
            color: #e5e7eb !important;
        }

        .fi-fo-select .choices__item--selectable.is-highlighted,
        .fi-fo-select .choices__item--selectable:hover {
            background-color: rgb(55, 65, 81) !important;
            color: white !important;
        }

        /* Listbox dropdown (Filament v3) */
        [data-headlessui-state] {
            background-color: rgb(31, 41, 55) !important;
            border: 1px solid rgb(55, 65, 81) !important;
            border-radius: 0.5rem;
        }

        /* Options in dropdown */
        .fi-fo-select-option,
        [role="option"] {
            color: #e5e7eb !important;
            padding: 0.75rem 1rem !important;
        }

        .fi-fo-select-option:hover,
        [role="option"]:hover,
        [role="option"][data-focus],
        [role="option"][data-selected] {
            background-color: rgb(55, 65, 81) !important;
            color: white !important;
        }

        /* Combobox listbox */
        .fi-fo-select [role="listbox"] {
            background-color: rgb(31, 41, 55) !important;
            border: 1px solid rgb(55, 65, 81) !important;
        }
    </style>

    {{-- Filterlar --}}
    <x-filament::section>
        <x-slot name="heading">Filterlar</x-slot>
        {{ $this->form }}
    </x-filament::section>

    @php
        $stats = $this->getPaymentStats();
        $total = $stats['range_0_25'] + $stats['range_25_50'] + $stats['range_50_75'] + $stats['range_75_100'];
    @endphp

    {{-- Stats Cards --}}
    <div style="display: grid; grid-template-columns: repeat(4, 1fr); gap: 1rem; margin-top: 1.5rem;">
        {{-- 0-25% --}}
        <div style="position: relative; overflow: hidden; border-radius: 1rem; background: linear-gradient(135deg, #ef4444, #dc2626); padding: 1.5rem; box-shadow: 0 10px 15px -3px rgba(0,0,0,0.1);">
            <div style="position: absolute; top: -1rem; right: -1rem; width: 6rem; height: 6rem; border-radius: 50%; background: rgba(255,255,255,0.1);"></div>
            <div style="position: relative;">
                <div style="font-size: 3rem; font-weight: 900; color: white;">{{ $stats['range_0_25'] }}</div>
                <div style="margin-top: 0.5rem; font-size: 1.125rem; font-weight: 600; color: rgba(255,255,255,0.9);">0% - 25%</div>
                <div style="margin-top: 0.25rem; font-size: 0.875rem; color: rgba(255,255,255,0.7);">Kam to'laganlar</div>
            </div>
        </div>

        {{-- 25-50% --}}
        <div style="position: relative; overflow: hidden; border-radius: 1rem; background: linear-gradient(135deg, #f97316, #ea580c); padding: 1.5rem; box-shadow: 0 10px 15px -3px rgba(0,0,0,0.1);">
            <div style="position: absolute; top: -1rem; right: -1rem; width: 6rem; height: 6rem; border-radius: 50%; background: rgba(255,255,255,0.1);"></div>
            <div style="position: relative;">
                <div style="font-size: 3rem; font-weight: 900; color: white;">{{ $stats['range_25_50'] }}</div>
                <div style="margin-top: 0.5rem; font-size: 1.125rem; font-weight: 600; color: rgba(255,255,255,0.9);">25% - 50%</div>
                <div style="margin-top: 0.25rem; font-size: 0.875rem; color: rgba(255,255,255,0.7);">Qisman to'laganlar</div>
            </div>
        </div>

        {{-- 50-75% --}}
        <div style="position: relative; overflow: hidden; border-radius: 1rem; background: linear-gradient(135deg, #eab308, #ca8a04); padding: 1.5rem; box-shadow: 0 10px 15px -3px rgba(0,0,0,0.1);">
            <div style="position: absolute; top: -1rem; right: -1rem; width: 6rem; height: 6rem; border-radius: 50%; background: rgba(255,255,255,0.1);"></div>
            <div style="position: relative;">
                <div style="font-size: 3rem; font-weight: 900; color: white;">{{ $stats['range_50_75'] }}</div>
                <div style="margin-top: 0.5rem; font-size: 1.125rem; font-weight: 600; color: rgba(255,255,255,0.9);">50% - 75%</div>
                <div style="margin-top: 0.25rem; font-size: 0.875rem; color: rgba(255,255,255,0.7);">Yarmidan ko'p</div>
            </div>
        </div>

        {{-- 75-100% --}}
        <div style="position: relative; overflow: hidden; border-radius: 1rem; background: linear-gradient(135deg, #22c55e, #16a34a); padding: 1.5rem; box-shadow: 0 10px 15px -3px rgba(0,0,0,0.1);">
            <div style="position: absolute; top: -1rem; right: -1rem; width: 6rem; height: 6rem; border-radius: 50%; background: rgba(255,255,255,0.1);"></div>
            <div style="position: relative;">
                <div style="font-size: 3rem; font-weight: 900; color: white;">{{ $stats['range_75_100'] }}</div>
                <div style="margin-top: 0.5rem; font-size: 1.125rem; font-weight: 600; color: rgba(255,255,255,0.9);">75% - 100%</div>
                <div style="margin-top: 0.25rem; font-size: 0.875rem; color: rgba(255,255,255,0.7);">Deyarli to'liq</div>
            </div>
        </div>
    </div>

    {{-- Chart Section --}}
    <div style="display: grid; grid-template-columns: repeat(2, 1fr); gap: 1.5rem; margin-top: 1.5rem;">
        {{-- Donut Chart --}}
        <div style="border-radius: 1rem; background: rgb(17, 24, 39); padding: 1.5rem; box-shadow: 0 10px 15px -3px rgba(0,0,0,0.1); border: 1px solid rgb(55, 65, 81);">
            <h3 style="font-size: 1.125rem; font-weight: 700; color: white; margin-bottom: 1rem;">To'lov foizi bo'yicha</h3>
            <div style="display: flex; justify-content: center;">
                <div style="width: 280px; height: 280px;">
                    <canvas id="paymentChart"></canvas>
                </div>
            </div>
        </div>

        {{-- Summary --}}
        <div style="border-radius: 1rem; background: rgb(17, 24, 39); padding: 1.5rem; box-shadow: 0 10px 15px -3px rgba(0,0,0,0.1); border: 1px solid rgb(55, 65, 81);">
            <h3 style="font-size: 1.125rem; font-weight: 700; color: white; margin-bottom: 1rem;">Umumiy ma'lumot</h3>

            {{-- Total --}}
            <div style="display: flex; align-items: center; justify-content: space-between; padding: 1rem; border-radius: 0.75rem; background: rgb(31, 41, 55); margin-bottom: 1rem;">
                <div style="display: flex; align-items: center; gap: 0.75rem;">
                    <div style="width: 2.5rem; height: 2.5rem; border-radius: 50%; background: rgba(59, 130, 246, 0.2); display: flex; align-items: center; justify-content: center;">
                        <svg style="width: 1.25rem; height: 1.25rem; color: #60a5fa;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                    </div>
                    <span style="font-weight: 500; color: #d1d5db;">Jami shartnomalar</span>
                </div>
                <span style="font-size: 1.5rem; font-weight: 700; color: white;">{{ $total }}</span>
            </div>

            {{-- Progress bars --}}
            @if($total > 0)
                {{-- 0-25% --}}
                <div style="margin-bottom: 0.75rem;">
                    <div style="display: flex; justify-content: space-between; font-size: 0.875rem; margin-bottom: 0.25rem;">
                        <span style="color: #9ca3af;">0% - 25%</span>
                        <span style="font-weight: 500; color: #ef4444;">{{ $stats['range_0_25'] }} ({{ $total > 0 ? round($stats['range_0_25'] / $total * 100, 1) : 0 }}%)</span>
                    </div>
                    <div style="height: 0.5rem; background: rgb(55, 65, 81); border-radius: 9999px; overflow: hidden;">
                        <div style="height: 100%; background: #ef4444; border-radius: 9999px; width: {{ $total > 0 ? $stats['range_0_25'] / $total * 100 : 0 }}%;"></div>
                    </div>
                </div>

                {{-- 25-50% --}}
                <div style="margin-bottom: 0.75rem;">
                    <div style="display: flex; justify-content: space-between; font-size: 0.875rem; margin-bottom: 0.25rem;">
                        <span style="color: #9ca3af;">25% - 50%</span>
                        <span style="font-weight: 500; color: #f97316;">{{ $stats['range_25_50'] }} ({{ $total > 0 ? round($stats['range_25_50'] / $total * 100, 1) : 0 }}%)</span>
                    </div>
                    <div style="height: 0.5rem; background: rgb(55, 65, 81); border-radius: 9999px; overflow: hidden;">
                        <div style="height: 100%; background: #f97316; border-radius: 9999px; width: {{ $total > 0 ? $stats['range_25_50'] / $total * 100 : 0 }}%;"></div>
                    </div>
                </div>

                {{-- 50-75% --}}
                <div style="margin-bottom: 0.75rem;">
                    <div style="display: flex; justify-content: space-between; font-size: 0.875rem; margin-bottom: 0.25rem;">
                        <span style="color: #9ca3af;">50% - 75%</span>
                        <span style="font-weight: 500; color: #eab308;">{{ $stats['range_50_75'] }} ({{ $total > 0 ? round($stats['range_50_75'] / $total * 100, 1) : 0 }}%)</span>
                    </div>
                    <div style="height: 0.5rem; background: rgb(55, 65, 81); border-radius: 9999px; overflow: hidden;">
                        <div style="height: 100%; background: #eab308; border-radius: 9999px; width: {{ $total > 0 ? $stats['range_50_75'] / $total * 100 : 0 }}%;"></div>
                    </div>
                </div>

                {{-- 75-100% --}}
                <div>
                    <div style="display: flex; justify-content: space-between; font-size: 0.875rem; margin-bottom: 0.25rem;">
                        <span style="color: #9ca3af;">75% - 100%</span>
                        <span style="font-weight: 500; color: #22c55e;">{{ $stats['range_75_100'] }} ({{ $total > 0 ? round($stats['range_75_100'] / $total * 100, 1) : 0 }}%)</span>
                    </div>
                    <div style="height: 0.5rem; background: rgb(55, 65, 81); border-radius: 9999px; overflow: hidden;">
                        <div style="height: 100%; background: #22c55e; border-radius: 9999px; width: {{ $total > 0 ? $stats['range_75_100'] / $total * 100 : 0 }}%;"></div>
                    </div>
                </div>
            @else
                <div style="text-align: center; padding: 2rem; color: #9ca3af;">
                    Ma'lumot topilmadi
                </div>
            @endif
        </div>
    </div>

    {{-- Chart.js --}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const ctx = document.getElementById('paymentChart');
            if (ctx) {
                new Chart(ctx, {
                    type: 'doughnut',
                    data: {
                        labels: ['0-25%', '25-50%', '50-75%', '75-100%'],
                        datasets: [{
                            data: [
                                {{ $stats['range_0_25'] }},
                                {{ $stats['range_25_50'] }},
                                {{ $stats['range_50_75'] }},
                                {{ $stats['range_75_100'] }}
                            ],
                            backgroundColor: ['#ef4444', '#f97316', '#eab308', '#22c55e'],
                            borderWidth: 0,
                            hoverOffset: 10
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: true,
                        cutout: '65%',
                        plugins: {
                            legend: {
                                position: 'bottom',
                                labels: {
                                    padding: 20,
                                    usePointStyle: true,
                                    pointStyle: 'circle',
                                    color: '#9ca3af'
                                }
                            }
                        }
                    }
                });
            }
        });
    </script>
</x-filament-panels::page>
