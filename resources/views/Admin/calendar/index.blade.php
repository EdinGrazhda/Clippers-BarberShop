<x-layouts.app :title="__('Calendar')">
@once
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <style>
        /* Custom scrollbar styles */
        .scrollbar-thin {
            scrollbar-width: thin;
        }
        
        .scrollbar-thin::-webkit-scrollbar {
            width: 6px;
        }
        
        .scrollbar-thin::-webkit-scrollbar-track {
            background: transparent;
        }
        
        .scrollbar-thin::-webkit-scrollbar-thumb {
            background-color: rgba(156, 163, 175, 0.5);
            border-radius: 3px;
        }
        
        .scrollbar-thin::-webkit-scrollbar-thumb:hover {
            background-color: rgba(156, 163, 175, 0.8);
        }
        
        /* Dark mode scrollbar */
        .dark .scrollbar-thin::-webkit-scrollbar-thumb {
            background-color: rgba(75, 85, 99, 0.5);
        }
        
        .dark .scrollbar-thin::-webkit-scrollbar-thumb:hover {
            background-color: rgba(75, 85, 99, 0.8);
        }
        
        /* Animation for appointment count badge */
        .appointment-count {
            animation: pulse 2s infinite;
        }
        
        @keyframes pulse {
            0%, 100% {
                transform: scale(1);
            }
            50% {
                transform: scale(1.1);
            }
        }
    </style>
@endonce
    <div class="min-h-screen bg-gray-50 dark:bg-gray-900 py-8" x-data="calendarApp()" x-init="init()">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Header -->
            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg border border-gray-200 dark:border-gray-700 p-8 mb-8">
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between">
                    <div>
                        <div class="flex items-center mb-2">
                            <div class="p-3 bg-gradient-to-br from-blue-500 to-purple-600 rounded-xl mr-4">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3a4 4 0 118 0v4m-4 9a3 3 0 100-6 3 3 0 000 6z"/>
                                </svg>
                            </div>
                            <h1 class="text-4xl font-bold bg-gradient-to-r from-gray-900 to-gray-600 dark:from-gray-100 dark:to-gray-300 bg-clip-text text-transparent">Calendar</h1>
                        </div>
                        <p class="text-gray-600 dark:text-gray-400 text-lg">Weekly appointment schedule view</p>
                    </div>
                    
                    <!-- Month Navigation -->
                    <div class="mt-6 sm:mt-0 flex items-center space-x-4">
                        <!-- Month Navigation -->
                        <div class="flex items-center space-x-2 bg-gray-100 dark:bg-gray-700 rounded-lg p-1">
                            <button @click="previousMonth()" class="p-2 hover:bg-gray-200 dark:hover:bg-gray-600 rounded-md transition-colors duration-200" title="Previous Month">
                                <svg class="w-4 h-4 text-gray-600 dark:text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 19l-7-7 7-7m8 14l-7-7 7-7"/>
                                </svg>
                            </button>
                            <span class="text-xs text-gray-500 dark:text-gray-400 px-2">Month</span>
                            <button @click="nextMonth()" class="p-2 hover:bg-gray-200 dark:hover:bg-gray-600 rounded-md transition-colors duration-200" title="Next Month">
                                <svg class="w-4 h-4 text-gray-600 dark:text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 5l7 7-7 7M5 5l7 7-7 7"/>
                                </svg>
                            </button>
                        </div>
                        
                        <!-- Week Navigation -->
                        <div class="flex items-center space-x-2 bg-gray-100 dark:bg-gray-700 rounded-lg p-1">
                            <button @click="previousWeek()" class="p-2 hover:bg-gray-200 dark:hover:bg-gray-600 rounded-md transition-colors duration-200" title="Previous Week">
                                <svg class="w-4 h-4 text-gray-600 dark:text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                                </svg>
                            </button>
                            <span class="text-xs text-gray-500 dark:text-gray-400 px-2">Week</span>
                            <button @click="nextWeek()" class="p-2 hover:bg-gray-200 dark:hover:bg-gray-600 rounded-md transition-colors duration-200" title="Next Week">
                                <svg class="w-4 h-4 text-gray-600 dark:text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                </svg>
                            </button>
                        </div>
                        
                        <div class="text-center">
                            <h2 class="text-xl font-semibold text-gray-900 dark:text-gray-100" x-text="currentMonthYear"></h2>
                            <p class="text-sm text-gray-500 dark:text-gray-400" x-text="currentWeekRange"></p>
                        </div>
                        
                        <button @click="goToToday()" class="px-4 py-2 bg-gradient-to-r from-blue-600 to-purple-600 hover:from-blue-700 hover:to-purple-700 text-white text-sm font-semibold rounded-lg transition-colors duration-200">
                            Today
                        </button>
                    </div>
                </div>
            </div>

            <!-- Calendar Grid -->
            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg border border-gray-200 dark:border-gray-700 overflow-hidden">
                <div class="overflow-x-auto">
                    <div class="min-w-full">
                        <!-- Header Row with Days -->
                        <div class="grid grid-cols-8 border-b border-gray-200 dark:border-gray-700">
                            <!-- Time Column Header -->
                            <div class="p-4 bg-gray-50 dark:bg-gray-700 text-sm font-medium text-gray-500 dark:text-gray-300 border-r border-gray-200 dark:border-gray-700">
                                Time
                            </div>
                            
                            <!-- Day Headers -->
                            <template x-for="day in weekDays" :key="day.date">
                                <div class="p-4 bg-gray-50 dark:bg-gray-700 text-center border-r border-gray-200 dark:border-gray-700 last:border-r-0">
                                    <div class="text-sm font-medium text-gray-900 dark:text-gray-100" x-text="day.name"></div>
                                    <div class="text-xs text-gray-500 dark:text-gray-400 mt-1" x-text="day.date"></div>
                                </div>
                            </template>
                        </div>

                        <!-- Time Slots Grid -->
                        <template x-for="timeSlot in timeSlots" :key="timeSlot.time">
                            <div class="grid grid-cols-8 border-b border-gray-200 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-700/50 transition-colors duration-200">
                                <!-- Time Column -->
                                <div class="p-4 bg-gray-50 dark:bg-gray-700 text-sm font-medium text-gray-600 dark:text-gray-300 border-r border-gray-200 dark:border-gray-700 flex items-center">
                                    <span x-text="timeSlot.display"></span>
                                </div>
                                
                                <!-- Day Columns -->
                                <template x-for="day in weekDays" :key="day.date + timeSlot.time">
                                    <div class="relative min-h-[80px] max-h-[120px] border-r border-gray-200 dark:border-gray-700 last:border-r-0">
                                        <!-- Scrollable appointments container -->
                                        <div class="h-full p-2 overflow-y-auto scrollbar-thin scrollbar-thumb-gray-300 dark:scrollbar-thumb-gray-600 scrollbar-track-transparent hover:scrollbar-thumb-gray-400 dark:hover:scrollbar-thumb-gray-500">
                                            <!-- Appointments for this time slot and day -->
                                            <template x-for="appointment in getAppointmentsForSlot(day.fullDate, timeSlot.time)" :key="appointment.id">
                                                <div class="mb-1 p-2 rounded-lg text-xs cursor-pointer transition-all duration-200 hover:shadow-md flex-shrink-0"
                                                     :class="getAppointmentStatusClass(appointment.status)"
                                                     @click="viewAppointmentDetails(appointment)"
                                                     :title="`${appointment.customer_name} with ${appointment.barber.name}`">
                                                    <div class="font-semibold truncate" x-text="appointment.customer_name"></div>
                                                    <div class="text-xs opacity-75 truncate" x-text="appointment.barber.name"></div>
                                                    <div class="text-xs opacity-60 truncate" x-text="appointment.service || 'Service'"></div>
                                                </div>
                                            </template>
                                        </div>
                                        
                                        <!-- Add appointment button (appears on hover) -->
                                        <button @click="addAppointmentToSlot(day.fullDate, timeSlot.time)" 
                                                class="absolute inset-0 w-full h-full bg-blue-500/10 hover:bg-blue-500/20 opacity-0 hover:opacity-100 transition-opacity duration-200 flex items-center justify-center rounded-lg pointer-events-none"
                                                :class="getAppointmentsForSlot(day.fullDate, timeSlot.time).length > 0 ? 'hidden' : ''">
                                            <svg class="w-4 h-4 text-blue-600 dark:text-blue-400 pointer-events-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                                            </svg>
                                        </button>
                                        
                                        <!-- Appointment count indicator (shows when there are appointments) -->
                                        <div x-show="getAppointmentsForSlot(day.fullDate, timeSlot.time).length > 2" 
                                             class="absolute top-1 right-1 bg-blue-500 text-white text-xs rounded-full w-5 h-5 flex items-center justify-center font-bold z-10 shadow-sm appointment-count">
                                            <span x-text="getAppointmentsForSlot(day.fullDate, timeSlot.time).length"></span>
                                        </div>
                                    </div>
                                </template>
                            </div>
                        </template>
                    </div>
                </div>
            </div>

            <!-- Legend -->
            <div class="mt-6 bg-white dark:bg-gray-800 rounded-2xl shadow-lg border border-gray-200 dark:border-gray-700 p-6">
                <div class="flex justify-between items-start mb-4">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100">Appointment Status Legend</h3>
                    <div class="text-sm text-gray-500 dark:text-gray-400">
                        <span x-text="`${appointments.length} appointments loaded`"></span>
                    </div>
                </div>
                <div class="flex flex-wrap gap-4">
                    <div class="flex items-center space-x-2">
                        <div class="w-4 h-4 bg-yellow-200 border border-yellow-300 rounded"></div>
                        <span class="text-sm text-gray-600 dark:text-gray-300">Pending</span>
                    </div>
                    <div class="flex items-center space-x-2">
                        <div class="w-4 h-4 bg-blue-200 border border-blue-300 rounded"></div>
                        <span class="text-sm text-gray-600 dark:text-gray-300">Confirmed</span>
                    </div>
                    <div class="flex items-center space-x-2">
                        <div class="w-4 h-4 bg-green-200 border border-green-300 rounded"></div>
                        <span class="text-sm text-gray-600 dark:text-gray-300">Completed</span>
                    </div>
                    <div class="flex items-center space-x-2">
                        <div class="w-4 h-4 bg-red-200 border border-red-300 rounded"></div>
                        <span class="text-sm text-gray-600 dark:text-gray-300">Cancelled</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Appointment Details Modal -->
        <div x-show="showDetailsModal" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" class="fixed inset-0 z-50 overflow-y-auto" x-cloak>
            <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
                <div class="fixed inset-0 transition-opacity z-40" aria-hidden="true" @click="closeDetailsModal()">
                    <div class="absolute inset-0 bg-gray-900/60"></div>
                </div>

                <div @click.stop class="relative z-50 inline-block w-full max-w-md align-bottom bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-2xl px-4 pt-5 pb-4 text-left overflow-hidden shadow-2xl transform transition-all sm:my-8 sm:align-middle sm:p-6">
                    <div class="flex items-center justify-between mb-6">
                        <h3 class="text-lg leading-6 font-medium text-gray-900 dark:text-gray-100">Appointment Details</h3>
                        <button type="button" @click="closeDetailsModal()" class="text-gray-400 hover:text-gray-600 dark:text-gray-500 dark:hover:text-gray-300">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                            </svg>
                        </button>
                    </div>

                    <div x-show="selectedAppointment" class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-500 dark:text-gray-400">Customer</label>
                            <p class="mt-1 text-sm font-medium text-gray-900 dark:text-gray-100" x-text="selectedAppointment?.customer_name"></p>
                        </div>
                        
                        <div x-show="selectedAppointment?.customer_email">
                            <label class="block text-sm font-medium text-gray-500 dark:text-gray-400">Email</label>
                            <p class="mt-1 text-sm text-gray-900 dark:text-gray-100" x-text="selectedAppointment?.customer_email"></p>
                        </div>
                        
                        <div x-show="selectedAppointment?.customer_phone">
                            <label class="block text-sm font-medium text-gray-500 dark:text-gray-400">Phone</label>
                            <p class="mt-1 text-sm text-gray-900 dark:text-gray-100" x-text="selectedAppointment?.customer_phone"></p>
                        </div>
                        
                        <div x-show="selectedAppointment?.service">
                            <label class="block text-sm font-medium text-gray-500 dark:text-gray-400">Service</label>
                            <p class="mt-1 text-sm text-gray-900 dark:text-gray-100" x-text="selectedAppointment?.service"></p>
                        </div>
                        
                        <div>
                            <label class="block text-sm font-medium text-gray-500 dark:text-gray-400">Barber</label>
                            <p class="mt-1 text-sm text-gray-900 dark:text-gray-100" x-text="selectedAppointment?.barber?.name"></p>
                        </div>
                        
                        <div>
                            <label class="block text-sm font-medium text-gray-500 dark:text-gray-400">Date & Time</label>
                            <p class="mt-1 text-sm text-gray-900 dark:text-gray-100" x-text="formatAppointmentDateTime(selectedAppointment?.appointment_time)"></p>
                        </div>
                        
                        <div>
                            <label class="block text-sm font-medium text-gray-500 dark:text-gray-400">Status</label>
                            <span class="mt-1 inline-flex px-2 py-1 text-xs font-semibold rounded-full" :class="getStatusBadgeClass(selectedAppointment?.status)" x-text="selectedAppointment?.status ? selectedAppointment.status.charAt(0).toUpperCase() + selectedAppointment.status.slice(1) : ''"></span>
                        </div>
                        
                        <div x-show="selectedAppointment?.notes">
                            <label class="block text-sm font-medium text-gray-500 dark:text-gray-400">Notes</label>
                            <p class="mt-1 text-sm text-gray-900 dark:text-gray-100" x-text="selectedAppointment?.notes"></p>
                        </div>

                        <!-- Action Buttons -->
                        <div class="flex space-x-3 pt-4">
                            <a :href="`/appointments/${selectedAppointment?.id}/edit`" class="flex-1 px-4 py-2 bg-gradient-to-r from-purple-600 to-pink-600 hover:from-purple-700 hover:to-pink-700 text-white text-sm font-medium rounded-lg transition-colors duration-200 text-center">Edit</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function calendarApp() {
            return {
                currentDate: new Date(),
                appointments: [],
                showDetailsModal: false,
                selectedAppointment: null,
                timeSlots: [
                    { time: '08:00', display: '8:00 AM' },
                    { time: '08:30', display: '8:30 AM' },
                    { time: '09:00', display: '9:00 AM' },
                    { time: '09:30', display: '9:30 AM' },
                    { time: '10:00', display: '10:00 AM' },
                    { time: '10:30', display: '10:30 AM' },
                    { time: '11:00', display: '11:00 AM' },
                    { time: '11:30', display: '11:30 AM' },
                    { time: '12:00', display: '12:00 PM' },
                    { time: '12:30', display: '12:30 PM' },
                    { time: '13:00', display: '1:00 PM' },
                    { time: '13:30', display: '1:30 PM' },
                    { time: '14:00', display: '2:00 PM' },
                    { time: '14:30', display: '2:30 PM' },
                    { time: '15:00', display: '3:00 PM' },
                    { time: '15:30', display: '3:30 PM' },
                    { time: '16:00', display: '4:00 PM' },
                    { time: '16:30', display: '4:30 PM' },
                    { time: '17:00', display: '5:00 PM' },
                    { time: '17:30', display: '5:30 PM' },
                    { time: '18:00', display: '6:00 PM' }
                ],

                get currentMonthYear() {
                    return this.currentDate.toLocaleDateString('en-US', { 
                        month: 'long', 
                        year: 'numeric' 
                    });
                },

                get currentWeekRange() {
                    const startOfWeek = this.getStartOfWeek(this.currentDate);
                    const endOfWeek = new Date(startOfWeek);
                    endOfWeek.setDate(startOfWeek.getDate() + 6);
                    
                    return `${startOfWeek.toLocaleDateString('en-US', { month: 'short', day: 'numeric' })} - ${endOfWeek.toLocaleDateString('en-US', { month: 'short', day: 'numeric' })}`;
                },

                get weekDays() {
                    const startOfWeek = this.getStartOfWeek(this.currentDate);
                    const days = [];
                    const dayNames = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];
                    
                    for (let i = 0; i < 7; i++) {
                        const date = new Date(startOfWeek);
                        date.setDate(startOfWeek.getDate() + i);
                        
                        days.push({
                            name: dayNames[date.getDay()],
                            date: date.getDate(),
                            fullDate: date.toISOString().split('T')[0]
                        });
                    }
                    
                    return days;
                },

                async init() {
                    await this.loadAppointments();
                },

                async loadAppointments() {
                    try {
                        const startOfWeek = this.getStartOfWeek(this.currentDate);
                        const endOfWeek = new Date(startOfWeek);
                        endOfWeek.setDate(startOfWeek.getDate() + 6);
                        
                        const response = await fetch(`/api/appointments?start=${startOfWeek.toISOString().split('T')[0]}&end=${endOfWeek.toISOString().split('T')[0]}`);
                        if (response.ok) {
                            this.appointments = await response.json();
                        } else {
                            // Fallback: try to load from the appointments index page
                            console.warn('API endpoint not available, loading fallback data');
                            await this.loadFallbackAppointments();
                        }
                    } catch (error) {
                        console.error('Error loading appointments:', error);
                        // Try fallback method
                        await this.loadFallbackAppointments();
                    }
                },

                async loadFallbackAppointments() {
                    // Fallback: try to get data from Laravel blade or set empty
                    const fallbackData = @json(\App\Models\Appointment::with('barber')->get());
                    this.appointments = fallbackData || [];
                },

                getStartOfWeek(date) {
                    const d = new Date(date);
                    const day = d.getDay();
                    const diff = d.getDate() - day;
                    return new Date(d.setDate(diff));
                },

                previousWeek() {
                    // Create a new date object to ensure reactivity
                    const newDate = new Date(this.currentDate);
                    newDate.setDate(newDate.getDate() - 7);
                    this.currentDate = newDate;
                    this.loadAppointments();
                },

                nextWeek() {
                    // Create a new date object to ensure reactivity
                    const newDate = new Date(this.currentDate);
                    newDate.setDate(newDate.getDate() + 7);
                    this.currentDate = newDate;
                    this.loadAppointments();
                },

                previousMonth() {
                    // Create a new date object to ensure reactivity
                    const newDate = new Date(this.currentDate);
                    newDate.setMonth(newDate.getMonth() - 1);
                    this.currentDate = newDate;
                    this.loadAppointments();
                },

                nextMonth() {
                    // Create a new date object to ensure reactivity
                    const newDate = new Date(this.currentDate);
                    newDate.setMonth(newDate.getMonth() + 1);
                    this.currentDate = newDate;
                    this.loadAppointments();
                },

                goToToday() {
                    this.currentDate = new Date();
                    this.loadAppointments();
                },

                getAppointmentsForSlot(date, time) {
                    if (!this.appointments || this.appointments.length === 0) {
                        return [];
                    }
                    
                    return this.appointments.filter(appointment => {
                        if (!appointment.appointment_time) return false;
                        
                        const appointmentDate = new Date(appointment.appointment_time);
                        const appointmentDateStr = appointmentDate.toISOString().split('T')[0];
                        const appointmentTime = appointmentDate.toTimeString().slice(0, 5);
                        
                        return appointmentDateStr === date && appointmentTime === time;
                    });
                },

                getAppointmentStatusClass(status) {
                    const classes = {
                        'pending': 'bg-yellow-100 dark:bg-yellow-900/30 text-yellow-800 dark:text-yellow-200 border border-yellow-200 dark:border-yellow-700',
                        'confirmed': 'bg-blue-100 dark:bg-blue-900/30 text-blue-800 dark:text-blue-200 border border-blue-200 dark:border-blue-700',
                        'completed': 'bg-green-100 dark:bg-green-900/30 text-green-800 dark:text-green-200 border border-green-200 dark:border-green-700',
                        'cancelled': 'bg-red-100 dark:bg-red-900/30 text-red-800 dark:text-red-200 border border-red-200 dark:border-red-700'
                    };
                    return classes[status] || classes['pending'];
                },

                getStatusBadgeClass(status) {
                    const classes = {
                        'pending': 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900/30 dark:text-yellow-200',
                        'confirmed': 'bg-blue-100 text-blue-800 dark:bg-blue-900/30 dark:text-blue-200',
                        'completed': 'bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-200',
                        'cancelled': 'bg-red-100 text-red-800 dark:bg-red-900/30 dark:text-red-200'
                    };
                    return classes[status] || classes['pending'];
                },

                viewAppointmentDetails(appointment) {
                    this.selectedAppointment = appointment;
                    this.showDetailsModal = true;
                },

                closeDetailsModal() {
                    this.showDetailsModal = false;
                    this.selectedAppointment = null;
                },

                addAppointmentToSlot(date, time) {
                    // Redirect to appointment creation with pre-filled date and time
                    const dateTime = `${date}T${time}:00`;
                    window.location.href = `/appointments/create?datetime=${dateTime}`;
                },

                formatAppointmentDateTime(datetime) {
                    if (!datetime) return '';
                    const date = new Date(datetime);
                    return date.toLocaleDateString('en-US', { 
                        weekday: 'long',
                        year: 'numeric', 
                        month: 'long', 
                        day: 'numeric',
                        hour: 'numeric',
                        minute: '2-digit'
                    });
                }
            }
        }
    </script>
</x-layouts.app>