<x-layouts.app :title="__('Appointments Management')">
@once
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
@endonce
    <div class="min-h-screen bg-gray-50 dark:bg-gray-900 py-8" x-data="appointmentCrud()" x-init="init(); @if($errors->any()) modalMode='create'; prefillOld(); showModal=true; @endif">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Flash Messages -->
            @if(session('success'))
                <div class="mb-8 bg-emerald-50 dark:bg-emerald-900/20 border border-emerald-200 dark:border-emerald-800 text-emerald-800 dark:text-emerald-200 px-6 py-4 rounded-xl shadow-sm" role="alert" x-data="{show: true}" x-init="setTimeout(() => show = false, 3000)" x-show="show" x-transition>
                    <div class="flex items-center justify-between">
                        <div class="font-semibold">{{ session('success') }}</div>
                        <button @click="show = false" class="text-emerald-500 hover:text-emerald-700 dark:text-emerald-300 dark:hover:text-emerald-100">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </button>
                    </div>
                </div>
            @endif

            @if(session('error'))
                <div class="mb-8 bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-800 text-red-800 dark:text-red-200 px-6 py-4 rounded-xl shadow-sm" role="alert" x-data="{show: true}" x-init="setTimeout(() => show = false, 3000)" x-show="show" x-transition>
                    <div class="flex items-center justify-between">
                        <div class="font-semibold">{{ session('error') }}</div>
                        <button @click="show = false" class="text-red-500 hover:text-red-700 dark:text-red-300 dark:hover:text-red-100">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </button>
                    </div>
                </div>
            @endif

            <!-- Header -->
            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg border border-gray-200 dark:border-gray-700 p-8 mb-8">
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between">
                    <div>
                        <div class="flex items-center mb-2">
                            <div class="p-3 bg-gradient-to-br from-purple-500 to-pink-600 rounded-xl mr-4">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3a4 4 0 118 0v4m-4 9a3 3 0 100-6 3 3 0 000 6z"/>
                                </svg>
                            </div>
                            <h1 class="text-4xl font-bold bg-gradient-to-r from-gray-900 to-gray-600 dark:from-gray-100 dark:to-gray-300 bg-clip-text text-transparent">Appointments Management</h1>
                        </div>
                        <p class="text-gray-600 dark:text-gray-400 text-lg">Manage customer appointments and scheduling</p>
                    </div>
                    <div class="mt-6 sm:mt-0">
                        <button @click="openCreateModal()" class="group inline-flex items-center px-6 py-3 bg-gradient-to-r from-purple-600 to-pink-600 hover:from-purple-700 hover:to-pink-700 text-white text-sm font-semibold rounded-xl shadow-lg hover:shadow-xl transform hover:scale-105 transition-all duration-200">
                            <svg class="w-5 h-5 mr-2 group-hover:rotate-90 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                            </svg>
                            New Appointment
                        </button>
                    </div>
                </div>
            </div>

            <!-- Filters -->
            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg border border-gray-200 dark:border-gray-700 p-6 mb-8">
                <form method="GET" class="grid grid-cols-1 md:grid-cols-5 gap-4" x-on:submit.prevent>
                    <!-- Search -->
                    <div>
                        <label for="search" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Search</label>
                        <input type="text" name="search" id="search" value="{{ request('search') }}" placeholder="Search appointments..."
                               x-model.debounce.300ms="filters.search" @input.debounce.300ms="updateTable()"
                               class="w-full px-3 py-2 bg-white dark:bg-gray-900 border border-gray-300 dark:border-gray-700 text-gray-900 dark:text-gray-100 placeholder-gray-400 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500">
                    </div>

                    <!-- Status Filter -->
                    <div>
                        <label for="status" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Status</label>
                        <select name="status" id="status"
                                x-model="filters.status" @change="updateTable()"
                                class="w-full px-3 py-2 bg-white dark:bg-gray-900 border border-gray-300 dark:border-gray-700 text-gray-900 dark:text-gray-100 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500">
                            <option value="">All Status</option>
                            <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="confirmed" {{ request('status') == 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                            <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>Completed</option>
                            <option value="cancelled" {{ request('status') == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                        </select>
                    </div>

                    <!-- Barber Filter -->
                    <div>
                        <label for="barber_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Barber</label>
                        <select name="barber_id" id="barber_id"
                                x-model="filters.barber_id" @change="updateTable()"
                                class="w-full px-3 py-2 bg-white dark:bg-gray-900 border border-gray-300 dark:border-gray-700 text-gray-900 dark:text-gray-100 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500">
                            <option value="">All Barbers</option>
                            @foreach($barbers as $barber)
                                <option value="{{ $barber->id }}" {{ request('barber_id') == $barber->id ? 'selected' : '' }}>{{ $barber->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Date Filter -->
                    <div>
                        <label for="date" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Date</label>
                        <input type="date" name="date" id="date" value="{{ request('date') }}"
                               x-model="filters.date" @change="updateTable()"
                               class="w-full px-3 py-2 bg-white dark:bg-gray-900 border border-gray-300 dark:border-gray-700 text-gray-900 dark:text-gray-100 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500">
                    </div>

                    <!-- Filter Buttons -->
                    <div class="flex items-end space-x-2">
                        <button type="button" @click="updateTable()" class="flex-1 px-4 py-2 bg-gradient-to-r from-purple-600 to-pink-600 hover:from-purple-700 hover:to-pink-700 text-white text-sm font-semibold rounded-lg transition-colors duration-200">Filter</button>
                        <button type="button" @click="resetFilters()" class="px-4 py-2 bg-gray-200 dark:bg-gray-700 hover:bg-gray-300 dark:hover:bg-gray-600 text-gray-800 dark:text-gray-200 text-sm font-medium rounded-lg transition-colors duration-200">Clear</button>
                    </div>
                </form>
            </div>

            <!-- Appointments Table -->
            <div id="appointmentsTable" class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg border border-gray-200 dark:border-gray-700 overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                        <thead class="bg-gray-50 dark:bg-gray-700">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Customer</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Barber</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Date & Time</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Status</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Phone</th>
                                <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                            @forelse($appointments as $appointment)
                                <tr class="hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors duration-200">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm font-medium text-gray-900 dark:text-gray-100">{{ $appointment->customer_name }}</div>
                                        @if($appointment->notes)
                                            <div class="text-sm text-gray-500 dark:text-gray-400 truncate max-w-xs">{{ Str::limit($appointment->notes, 50) }}</div>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900 dark:text-gray-100">{{ $appointment->barber->name }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900 dark:text-gray-100">{{ $appointment->appointment_time->format('M d, Y') }}</div>
                                        <div class="text-sm text-gray-500 dark:text-gray-400">{{ $appointment->appointment_time->format('h:i A') }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full 
                                            @if($appointment->status === 'pending') bg-yellow-100 text-yellow-800 dark:bg-yellow-900/30 dark:text-yellow-300
                                            @elseif($appointment->status === 'confirmed') bg-blue-100 text-blue-800 dark:bg-blue-900/30 dark:text-blue-300
                                            @elseif($appointment->status === 'completed') bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-300
                                            @else bg-red-100 text-red-800 dark:bg-red-900/30 dark:text-red-300 @endif">
                                            {{ ucfirst($appointment->status) }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                                        {{ $appointment->customer_phone ?: 'N/A' }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                        <div class="flex items-center justify-end space-x-2">
                                            <button @click="viewAppointment({{ $appointment->id }})" class="text-blue-600 hover:text-blue-900 dark:text-blue-400 dark:hover:text-blue-300">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                                </svg>
                                            </button>
                                            <button @click="editAppointment({{ $appointment->id }})" class="text-amber-600 hover:text-amber-900 dark:text-amber-400 dark:hover:text-amber-300">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                                </svg>
                                            </button>
                                            <button @click="confirmDelete({{ $appointment->id }}, '{{ $appointment->customer_name }}')" class="text-red-600 hover:text-red-900 dark:text-red-400 dark:hover:text-red-300">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                                </svg>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="px-6 py-12 text-center">
                                        <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3a4 4 0 118 0v4m-4 9a3 3 0 100-6 3 3 0 000 6z"/>
                                        </svg>
                                        <h3 class="mt-2 text-sm font-medium text-gray-900 dark:text-gray-100">No appointments found</h3>
                                        <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Get started by creating your first appointment.</p>
                                        <div class="mt-6">
                                            <button @click="openCreateModal()" class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-purple-600 to-pink-600 hover:from-purple-700 hover:to-pink-700 text-white text-sm font-semibold rounded-lg">New Appointment</button>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Pagination -->
            @if($appointments->hasPages())
                <div id="paginationContainer" class="mt-6 bg-white dark:bg-gray-800 rounded-2xl shadow-lg border border-gray-200 dark:border-gray-700 p-6">
                    {{ $appointments->links() }}
                </div>
            @endif
        </div>

        <!-- Create/Edit Modal -->
        <div x-show="showModal" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" class="fixed inset-0 z-50 overflow-y-auto" x-cloak>
            <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
                <div class="fixed inset-0 transition-opacity z-40" aria-hidden="true" @click="closeModal()">
                    <div class="absolute inset-0 bg-gray-900/60"></div>
                </div>

                <div @click.stop class="relative z-50 inline-block w-full max-w-md sm:max-w-lg md:max-w-xl align-bottom bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-2xl px-4 pt-5 pb-4 text-left overflow-hidden shadow-2xl transform transition-all sm:my-8 sm:align-middle sm:p-6" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100" x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100" x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95">
                    
                    <form :action="modalMode === 'create' ? '{{ route('appointments.store') }}' : '/appointments/' + editingAppointment.id" method="POST">
                        @csrf
                        @if($errors->any())
                            <div class="mb-4 rounded-lg border border-red-200 dark:border-red-800 bg-red-50 dark:bg-red-900/20 p-3 text-sm text-red-700 dark:text-red-300">
                                <div class="font-medium mb-1">There were problems with your submission:</div>
                                <ul class="list-disc list-inside space-y-1">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <!-- Only include _method=PUT when editing -->
                        <template x-if="modalMode === 'edit'">
                            <input type="hidden" name="_method" value="PUT">
                        </template>

                        <div class="flex items-center justify-between mb-6">
                            <h3 class="text-lg leading-6 font-medium text-gray-900 dark:text-gray-100" x-text="modalMode === 'create' ? 'New Appointment' : 'Edit Appointment'"></h3>
                            <button type="button" @click="closeModal()" class="text-gray-400 hover:text-gray-600 dark:text-gray-500 dark:hover:text-gray-300">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                </svg>
                            </button>
                        </div>

                        <div class="space-y-4">
                            <!-- Customer Name -->
                            <div>
                                <label for="customer_name" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Customer Name *</label>
                                <input type="text" name="customer_name" id="customer_name" x-model="formData.customer_name" required class="w-full px-3 py-2 bg-white dark:bg-gray-900 border border-gray-300 dark:border-gray-700 text-gray-900 dark:text-gray-100 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500">
                            </div>

                            <!-- Customer Phone -->
                            <div>
                                <label for="customer_phone" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Customer Phone</label>
                                <input type="text" name="customer_phone" id="customer_phone" x-model="formData.customer_phone" class="w-full px-3 py-2 bg-white dark:bg-gray-900 border border-gray-300 dark:border-gray-700 text-gray-900 dark:text-gray-100 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500">
                            </div>

                            <!-- Barber -->
                            <div>
                                <label for="barber_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Barber *</label>
                                <select name="barber_id" id="barber_id" x-model="formData.barber_id" required class="w-full px-3 py-2 bg-white dark:bg-gray-900 border border-gray-300 dark:border-gray-700 text-gray-900 dark:text-gray-100 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500">
                                    <option value="">Select a barber</option>
                                    @foreach($barbers as $barber)
                                        <option value="{{ $barber->id }}">{{ $barber->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Appointment Date & Time -->
                            <div>
                                <label for="appointment_time" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Appointment Date & Time *</label>
                                <input type="datetime-local" name="appointment_time" id="appointment_time" x-model="formData.appointment_time" required class="w-full px-3 py-2 bg-white dark:bg-gray-900 border border-gray-300 dark:border-gray-700 text-gray-900 dark:text-gray-100 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500">
                            </div>

                            <!-- Status -->
                            <div>
                                <label for="status" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Status *</label>
                                <select name="status" id="status" x-model="formData.status" required class="w-full px-3 py-2 bg-white dark:bg-gray-900 border border-gray-300 dark:border-gray-700 text-gray-900 dark:text-gray-100 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500">
                                    <option value="pending">Pending</option>
                                    <option value="confirmed">Confirmed</option>
                                    <option value="completed">Completed</option>
                                    <option value="cancelled">Cancelled</option>
                                </select>
                            </div>

                            <!-- Notes -->
                            <div>
                                <label for="notes" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Notes</label>
                                <textarea name="notes" id="notes" x-model="formData.notes" rows="3" maxlength="1000" class="w-full px-3 py-2 bg-white dark:bg-gray-900 border border-gray-300 dark:border-gray-700 text-gray-900 dark:text-gray-100 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500" placeholder="Additional notes or special requests..."></textarea>
                            </div>
                        </div>

                        <!-- Modal Footer -->
                        <div class="mt-6 flex flex-col sm:flex-row sm:justify-end space-y-2 sm:space-y-0 sm:space-x-3">
                            <button type="button" @click="closeModal()" class="w-full sm:w-auto px-4 py-2 bg-gray-200 hover:bg-gray-300 dark:bg-gray-700 dark:hover:bg-gray-600 text-gray-800 dark:text-gray-200 text-sm font-medium rounded-lg transition-colors duration-200">Cancel</button>
                            <button type="submit" class="w-full sm:w-auto px-4 py-2 bg-gradient-to-r from-purple-600 to-pink-600 hover:from-purple-700 hover:to-pink-700 text-white text-sm font-medium rounded-lg transition-colors duration-200">
                                <span x-text="modalMode === 'create' ? 'Create Appointment' : 'Update Appointment'"></span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- View Modal -->
        <div x-show="showViewModal" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" class="fixed inset-0 z-50 overflow-y-auto" x-cloak>
            <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
                <div class="fixed inset-0 transition-opacity z-40" aria-hidden="true" @click="closeViewModal()">
                    <div class="absolute inset-0 bg-gray-900/60"></div>
                </div>

                <div @click.stop class="relative z-50 inline-block w-full max-w-md sm:max-w-lg align-bottom bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-2xl px-4 pt-5 pb-4 text-left overflow-hidden shadow-2xl transform transition-all sm:my-8 sm:align-middle sm:p-6" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100" x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100" x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95">
                    
                    <div class="flex items-center justify-between mb-6">
                        <h3 class="text-lg leading-6 font-medium text-gray-900 dark:text-gray-100">Appointment Details</h3>
                        <button type="button" @click="closeViewModal()" class="text-gray-400 hover:text-gray-600 dark:text-gray-500 dark:hover:text-gray-300">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                            </svg>
                        </button>
                    </div>

                    <div x-show="viewingAppointment" class="space-y-4">
                        <!-- Customer Info -->
                        <div>
                            <label class="block text-sm font-medium text-gray-500 dark:text-gray-400">Customer</label>
                            <p class="mt-1 text-sm font-medium text-gray-900 dark:text-gray-100" x-text="viewingAppointment.customer_name"></p>
                        </div>
                        
                        <div x-show="viewingAppointment.customer_phone">
                            <label class="block text-sm font-medium text-gray-500 dark:text-gray-400">Phone</label>
                            <p class="mt-1 text-sm text-gray-900 dark:text-gray-100" x-text="viewingAppointment.customer_phone"></p>
                        </div>
                        
                        <div>
                            <label class="block text-sm font-medium text-gray-500 dark:text-gray-400">Barber</label>
                            <p class="mt-1 text-sm text-gray-900 dark:text-gray-100" x-text="viewingAppointment.barber?.name"></p>
                        </div>
                        
                        <div>
                            <label class="block text-sm font-medium text-gray-500 dark:text-gray-400">Date & Time</label>
                            <p class="mt-1 text-sm text-gray-900 dark:text-gray-100" x-text="formatDateTime(viewingAppointment.appointment_time)"></p>
                        </div>
                        
                        <div>
                            <label class="block text-sm font-medium text-gray-500 dark:text-gray-400">Status</label>
                            <span class="mt-1 inline-flex px-2 py-1 text-xs font-semibold rounded-full" :class="getStatusColor(viewingAppointment.status)" x-text="viewingAppointment.status ? viewingAppointment.status.charAt(0).toUpperCase() + viewingAppointment.status.slice(1) : ''"></span>
                        </div>
                        
                        <div x-show="viewingAppointment.notes">
                            <label class="block text-sm font-medium text-gray-500 dark:text-gray-400">Notes</label>
                            <p class="mt-1 text-sm text-gray-900 dark:text-gray-100" x-text="viewingAppointment.notes"></p>
                        </div>

                        <!-- Action Buttons -->
                        <div class="flex space-x-3 pt-4">
                            <button @click="editAppointment(viewingAppointment.id); closeViewModal()" class="flex-1 px-4 py-2 bg-gradient-to-r from-purple-600 to-pink-600 hover:from-purple-700 hover:to-pink-700 text-white text-sm font-medium rounded-lg transition-colors duration-200">Edit Appointment</button>
                            <button @click="confirmDelete(viewingAppointment.id, viewingAppointment.customer_name); closeViewModal()" class="flex-1 px-4 py-2 bg-red-600 hover:bg-red-700 text-white text-sm font-medium rounded-lg transition-colors duration-200">Delete</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Delete Confirmation Modal -->
        <div x-show="showDeleteModal" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" class="fixed inset-0 z-50 overflow-y-auto" x-cloak>
            <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
                <div class="fixed inset-0 transition-opacity z-40" aria-hidden="true" @click="closeDeleteModal()">
                    <div class="absolute inset-0 bg-gray-900/60"></div>
                </div>

                <div @click.stop class="relative z-50 inline-block w-full max-w-md align-bottom bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-2xl px-4 pt-5 pb-4 text-left overflow-hidden shadow-2xl transform transition-all sm:my-8 sm:align-middle sm:p-6" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100" x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100" x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95">
                    
                    <div class="sm:flex sm:items-start">
                        <div class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-red-100 dark:bg-red-900/30 sm:mx-0 sm:h-10 sm:w-10">
                            <svg class="h-6 w-6 text-red-600 dark:text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16c-.77.833.192 2.5 1.732 2.5z"/>
                            </svg>
                        </div>
                        <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                            <h3 class="text-lg leading-6 font-medium text-gray-900 dark:text-gray-100">Delete Appointment</h3>
                            <div class="mt-2">
                                <p class="text-sm text-gray-600 dark:text-gray-300">Are you sure you want to delete the appointment for <span x-text="deleteAppointmentName" class="font-medium"></span>? This action cannot be undone.</p>
                            </div>
                        </div>
                    </div>
                    <div class="mt-5 sm:mt-4 sm:flex sm:flex-row-reverse">
                        <form :action="'/appointments/' + deleteAppointmentId" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="w-full inline-flex justify-center rounded-lg border border-transparent shadow-sm px-4 py-2 bg-red-600 text-base font-medium text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 sm:ml-3 sm:w-auto sm:text-sm">Delete</button>
                        </form>
                        <button type="button" @click="closeDeleteModal()" class="mt-3 w-full inline-flex justify-center rounded-lg border border-gray-300 dark:border-gray-700 shadow-sm px-4 py-2 bg-white dark:bg-gray-900 text-base font-medium text-gray-700 dark:text-gray-200 hover:bg-gray-50 dark:hover:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500 sm:mt-0 sm:w-auto sm:text-sm">Cancel</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function appointmentCrud() {
            return {
                showModal: false,
                showViewModal: false,
                showDeleteModal: false,
                modalMode: 'create', // 'create' or 'edit'
                editingAppointment: null,
                viewingAppointment: null,
                deleteAppointmentId: null,
                deleteAppointmentName: '',
                formData: {
                    customer_name: '',
                    customer_phone: '',
                    barber_id: '',
                    appointment_time: '',
                    status: 'pending',
                    notes: ''
                },
                filters: {
                    search: @json(request('search')) || '',
                    status: @json(request('status')) || '',
                    barber_id: @json(request('barber_id')) || '',
                    date: @json(request('date')) || ''
                },
                prefillOld() {
                    this.formData.customer_name = @json(old('customer_name')) || '';
                    this.formData.customer_phone = @json(old('customer_phone')) || '';
                    this.formData.barber_id = @json(old('barber_id')) || '';
                    this.formData.appointment_time = @json(old('appointment_time')) || '';
                    this.formData.status = @json(old('status')) || 'pending';
                    this.formData.notes = @json(old('notes')) || '';
                },
                init() {
                    // Intercept pagination clicks to keep updates realtime
                    document.addEventListener('click', (e) => {
                        const a = e.target.closest('#paginationContainer a');
                        if (!a) return;
                        const url = new URL(a.href);
                        const page = url.searchParams.get('page');
                        if (page) {
                            e.preventDefault();
                            this.updateTable(page);
                        }
                    });
                },
                openCreateModal() {
                    this.modalMode = 'create';
                    this.resetForm();
                    this.showModal = true;
                },

                async editAppointment(appointmentId) {
                    try {
                        const response = await fetch(`/appointments/${appointmentId}`);
                        const appointment = await response.json();
                        
                        this.modalMode = 'edit';
                        this.editingAppointment = appointment;
                        this.formData = {
                            customer_name: appointment.customer_name || '',
                            customer_phone: appointment.customer_phone || '',
                            barber_id: appointment.barber_id || '',
                            appointment_time: appointment.appointment_time ? new Date(appointment.appointment_time).toISOString().slice(0, 16) : '',
                            status: appointment.status || 'pending',
                            notes: appointment.notes || ''
                        };
                        
                        this.showModal = true;
                    } catch (error) {
                        console.error('Error fetching appointment:', error);
                        alert('Error loading appointment data');
                    }
                },

                async viewAppointment(appointmentId) {
                    try {
                        const response = await fetch(`/appointments/${appointmentId}`);
                        const appointment = await response.json();
                        this.viewingAppointment = appointment;
                        this.showViewModal = true;
                    } catch (error) {
                        console.error('Error fetching appointment:', error);
                        alert('Error loading appointment data');
                    }
                },

                confirmDelete(appointmentId, customerName) {
                    this.deleteAppointmentId = appointmentId;
                    this.deleteAppointmentName = customerName;
                    this.showDeleteModal = true;
                },

                closeModal() {
                    this.showModal = false;
                    this.resetForm();
                },

                closeViewModal() {
                    this.showViewModal = false;
                    this.viewingAppointment = null;
                },

                closeDeleteModal() {
                    this.showDeleteModal = false;
                    this.deleteAppointmentId = null;
                    this.deleteAppointmentName = '';
                },

                resetForm() {
                    this.formData = {
                        customer_name: '',
                        customer_phone: '',
                        barber_id: '',
                        appointment_time: '',
                        status: 'pending',
                        notes: ''
                    };
                    this.editingAppointment = null;
                },

                async updateTable(page = null) {
                    try {
                        const params = new URLSearchParams();
                        if (this.filters.search) params.set('search', this.filters.search);
                        if (this.filters.status) params.set('status', this.filters.status);
                        if (this.filters.barber_id) params.set('barber_id', this.filters.barber_id);
                        if (this.filters.date) params.set('date', this.filters.date);
                        if (page) params.set('page', page);
                        const url = `${window.location.pathname}?${params.toString()}`;
                        const res = await fetch(url, { headers: { 'X-Requested-With': 'XMLHttpRequest' } });
                        const html = await res.text();
                        const doc = new DOMParser().parseFromString(html, 'text/html');
                        const newTable = doc.querySelector('#appointmentsTable');
                        const newPagination = doc.querySelector('#paginationContainer');
                        const table = document.querySelector('#appointmentsTable');
                        const pagination = document.querySelector('#paginationContainer');
                        if (newTable && table) table.innerHTML = newTable.innerHTML;
                        if (pagination) {
                            if (newPagination) pagination.innerHTML = newPagination.innerHTML; else pagination.innerHTML = '';
                        } else if (newPagination && table) {
                            table.insertAdjacentHTML('afterend', newPagination.outerHTML);
                        }
                        window.history.pushState({}, '', url);
                    } catch (e) {
                        console.error('Failed to update table', e);
                    }
                },

                resetFilters() {
                    this.filters.search = '';
                    this.filters.status = '';
                    this.filters.barber_id = '';
                    this.filters.date = '';
                    this.updateTable();
                },

                formatDateTime(dateTime) {
                    if (!dateTime) return '';
                    const date = new Date(dateTime);
                    return date.toLocaleDateString() + ' at ' + date.toLocaleTimeString([], {hour: '2-digit', minute:'2-digit'});
                },

                getStatusColor(status) {
                    switch(status) {
                        case 'pending': return 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900/30 dark:text-yellow-300';
                        case 'confirmed': return 'bg-blue-100 text-blue-800 dark:bg-blue-900/30 dark:text-blue-300';
                        case 'completed': return 'bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-300';
                        case 'cancelled': return 'bg-red-100 text-red-800 dark:bg-red-900/30 dark:text-red-300';
                        default: return 'bg-gray-100 text-gray-800 dark:bg-gray-900/30 dark:text-gray-300';
                    }
                }
            }
        }
    </script>

    <style>
        [x-cloak] { display: none !important; }
    </style>
</x-layouts.app>
