<x-layouts.app :title="__('Barbers Management')">
@once
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
@endonce
    <div class="min-h-screen bg-gray-50 dark:bg-gray-900 py-8" x-data="barberCrud()" x-init="init(); @if($errors->any()) modalMode='create'; prefillOld(); showModal=true; @endif">
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
                            <div class="p-3 bg-gradient-to-br from-blue-500 to-purple-600 rounded-xl mr-4">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/>
                                </svg>
                            </div>
                            <h1 class="text-4xl font-bold bg-gradient-to-r from-gray-900 to-gray-600 dark:from-gray-100 dark:to-gray-300 bg-clip-text text-transparent">Barbers Management</h1>
                        </div>
                        <p class="text-gray-600 dark:text-gray-400 text-lg">Manage your barbershop staff and their professional information</p>
                    </div>
                    <div class="mt-6 sm:mt-0">
                        <button @click="openCreateModal()" class="group inline-flex items-center px-6 py-3 bg-gradient-to-r from-blue-600 to-purple-600 hover:from-blue-700 hover:to-purple-700 text-white text-sm font-semibold rounded-xl shadow-lg hover:shadow-xl transform hover:scale-105 transition-all duration-200">
                            <svg class="w-5 h-5 mr-2 group-hover:rotate-90 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                            </svg>
                            Add New Barber
                        </button>
                    </div>
                </div>
            </div>

            <!-- Filters -->
            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg border border-gray-200 dark:border-gray-700 p-6 mb-8">
                <form method="GET" class="grid grid-cols-1 md:grid-cols-4 gap-4" x-on:submit.prevent>
                    <!-- Search -->
                    <div>
                        <label for="search" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Search</label>
                        <input type="text" name="search" id="search" value="{{ request('search') }}" placeholder="Search barbers..."
                               x-model.debounce.300ms="filters.search" @input.debounce.300ms="updateGrid()"
                               class="w-full px-3 py-2 bg-white dark:bg-gray-900 border border-gray-300 dark:border-gray-700 text-gray-900 dark:text-gray-100 placeholder-gray-400 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    </div>

                    <!-- Status Filter -->
                    <div>
                        <label for="status" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Status</label>
                        <select name="status" id="status"
                                x-model="filters.status" @change="updateGrid()"
                                class="w-full px-3 py-2 bg-white dark:bg-gray-900 border border-gray-300 dark:border-gray-700 text-gray-900 dark:text-gray-100 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                            <option value="">All Status</option>
                            <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>Active</option>
                            <option value="inactive" {{ request('status') == 'inactive' ? 'selected' : '' }}>Inactive</option>
                        </select>
                    </div>

                    <!-- Experience Filter -->
                    <div>
                        <label for="experience" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Experience</label>
                        <select name="experience" id="experience"
                                x-model="filters.experience" @change="updateGrid()"
                                class="w-full px-3 py-2 bg-white dark:bg-gray-900 border border-gray-300 dark:border-gray-700 text-gray-900 dark:text-gray-100 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                            <option value="">All Experience</option>
                            <option value="0-5" {{ request('experience') == '0-5' ? 'selected' : '' }}>0-5 years</option>
                            <option value="6-10" {{ request('experience') == '6-10' ? 'selected' : '' }}>6-10 years</option>
                            <option value="11-15" {{ request('experience') == '11-15' ? 'selected' : '' }}>11-15 years</option>
                            <option value="16+" {{ request('experience') == '16+' ? 'selected' : '' }}>16+ years</option>
                        </select>
                    </div>

                    <!-- Filter Buttons -->
                    <div class="flex items-end space-x-2">
                        <button type="button" @click="updateGrid()" class="flex-1 px-4 py-2 bg-gradient-to-r from-blue-600 to-purple-600 hover:from-blue-700 hover:to-purple-700 text-white text-sm font-semibold rounded-lg transition-colors duration-200">Filter</button>
                        <button type="button" @click="resetFilters()" class="px-4 py-2 bg-gray-200 dark:bg-gray-700 hover:bg-gray-300 dark:hover:bg-gray-600 text-gray-800 dark:text-gray-200 text-sm font-medium rounded-lg transition-colors duration-200">Clear</button>
                    </div>
                </form>
            </div>

            <!-- Barbers Grid -->
            <div id="barbersGrid" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
                @forelse($barbers as $barber)
                    <div class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-2xl shadow-sm overflow-hidden hover:shadow-xl transition-all duration-200 hover:-translate-y-0.5">
                        <!-- Barber Image -->
                        <div class="bg-gray-200 dark:bg-gray-700">
                            @if($barber->image)
                                <img src="{{ Storage::url($barber->image) }}" alt="{{ $barber->name }}" class="w-full h-48 object-cover">
                            @else
                                <div class="w-full h-48 bg-gradient-to-br from-blue-500 to-purple-600 flex items-center justify-center">
                                    <svg class="w-16 h-16 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                    </svg>
                                </div>
                            @endif
                        </div>

                        <!-- Barber Info -->
                        <div class="p-6">
                            <div class="flex items-start justify-between mb-3">
                                <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100">{{ $barber->name }}</h3>
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $barber->is_active ? 'bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-300' : 'bg-red-100 text-red-800 dark:bg-red-900/30 dark:text-red-300' }}">
                                    {{ $barber->is_active ? 'Active' : 'Inactive' }}
                                </span>
                            </div>

                            <div class="space-y-2 text-sm text-gray-600 dark:text-gray-300">
                                @if($barber->email)
                                    <div class="flex items-center">
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                        </svg>
                                        {{ $barber->email }}
                                    </div>
                                @endif

                                @if($barber->phone)
                                    <div class="flex items-center">
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                                        </svg>
                                        {{ $barber->phone }}
                                    </div>
                                @endif

                                <div class="flex items-center">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                    {{ $barber->experience_years }} years experience
                                </div>
                            </div>

                            @if($barber->description)
                                <p class="mt-3 text-sm text-gray-500 dark:text-gray-300 line-clamp-2">{{ $barber->description }}</p>
                            @endif

                            @if($barber->specialties && count($barber->specialties) > 0)
                                <div class="mt-3">
                                    <div class="flex flex-wrap gap-1">
                                        @foreach(array_slice($barber->specialties, 0, 3) as $specialty)
                                            <span class="inline-flex items-center px-2 py-1 rounded-md text-xs font-medium bg-blue-100 text-blue-800 dark:bg-blue-900/30 dark:text-blue-300">{{ $specialty }}</span>
                                        @endforeach
                                        @if(count($barber->specialties) > 3)
                                            <span class="inline-flex items-center px-2 py-1 rounded-md text-xs font-medium bg-gray-100 text-gray-600 dark:bg-gray-800 dark:text-gray-300">+{{ count($barber->specialties) - 3 }} more</span>
                                        @endif
                                    </div>
                                </div>
                            @endif

                            <!-- Action Buttons -->
                            <div class="mt-4 flex space-x-2">
                                <button @click="viewBarber({{ $barber->id }})" class="flex-1 px-3 py-2 bg-blue-50 hover:bg-blue-100 text-blue-700 dark:bg-blue-900/20 dark:hover:bg-blue-900/30 dark:text-blue-300 text-sm font-medium rounded-lg transition-colors duration-200">View</button>
                                <button @click="editBarber({{ $barber->id }})" class="flex-1 px-3 py-2 bg-amber-50 hover:bg-amber-100 text-amber-700 dark:bg-amber-900/20 dark:hover:bg-amber-900/30 dark:text-amber-300 text-sm font-medium rounded-lg transition-colors duration-200">Edit</button>
                                <button @click="confirmDelete({{ $barber->id }}, '{{ $barber->name }}')" class="flex-1 px-3 py-2 bg-red-50 hover:bg-red-100 text-red-700 dark:bg-red-900/20 dark:hover:bg-red-900/30 dark:text-red-300 text-sm font-medium rounded-lg transition-colors duration-200">Delete</button>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full text-center py-12">
                        <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                        </svg>
                        <h3 class="mt-2 text-sm font-medium text-gray-900 dark:text-gray-100">No barbers found</h3>
                        <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Get started by adding your first barber.</p>
                        <div class="mt-6">
                            <button @click="openCreateModal()" class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-blue-600 to-purple-600 hover:from-blue-700 hover:to-purple-700 text-white text-sm font-semibold rounded-lg">Add Barber</button>
                        </div>
                    </div>
                @endforelse
            </div>

            <!-- Pagination -->
            @if($barbers->hasPages())
                <div id="paginationContainer" class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg border border-gray-200 dark:border-gray-700 p-6">
                    {{ $barbers->links() }}
                </div>
            @endif
        </div>

        <!-- Create/Edit Modal -->
        <div x-show="showModal" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" class="fixed inset-0 z-50 overflow-y-auto" x-cloak>
            <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
                <div class="fixed inset-0 transition-opacity z-40" aria-hidden="true" @click="closeModal()">
                    <div class="absolute inset-0 bg-gray-900/60"></div>
                </div>

                <div @click.stop class="relative z-50 inline-block w-full max-w-md sm:max-w-lg md:max-w-xl lg:max-w-2xl align-bottom bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-2xl px-4 pt-5 pb-4 text-left overflow-hidden shadow-2xl transform transition-all sm:my-8 sm:align-middle sm:p-6" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100" x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100" x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95">
                    
                    <form :action="modalMode === 'create' ? '{{ route('barbers.store') }}' : '/barbers/' + editingBarber.id" method="POST" enctype="multipart/form-data">
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
                            <h3 class="text-lg leading-6 font-medium text-gray-900 dark:text-gray-100" x-text="modalMode === 'create' ? 'Add New Barber' : 'Edit Barber'"></h3>
                            <button type="button" @click="closeModal()" class="text-gray-400 hover:text-gray-600 dark:text-gray-500 dark:hover:text-gray-300">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                </svg>
                            </button>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Left Column -->
                            <div class="space-y-4">
                                <!-- Name -->
                                <div>
                                    <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Name *</label>
                                    <input type="text" name="name" id="name" x-model="formData.name" required class="w-full px-3 py-2 bg-white dark:bg-gray-900 border border-gray-300 dark:border-gray-700 text-gray-900 dark:text-gray-100 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                </div>

                                <!-- Email -->
                                <div>
                                    <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Email</label>
                                    <input type="email" name="email" id="email" x-model="formData.email" class="w-full px-3 py-2 bg-white dark:bg-gray-900 border border-gray-300 dark:border-gray-700 text-gray-900 dark:text-gray-100 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                </div>

                                <!-- Phone -->
                                <div>
                                    <label for="phone" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Phone</label>
                                    <input type="text" name="phone" id="phone" x-model="formData.phone" class="w-full px-3 py-2 bg-white dark:bg-gray-900 border border-gray-300 dark:border-gray-700 text-gray-900 dark:text-gray-100 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                </div>

                                <!-- Experience Years -->
                                <div>
                                    <label for="experience_years" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Experience (Years) *</label>
                                    <input type="number" name="experience_years" id="experience_years" x-model="formData.experience_years" min="0" max="50" required class="w-full px-3 py-2 bg-white dark:bg-gray-900 border border-gray-300 dark:border-gray-700 text-gray-900 dark:text-gray-100 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                </div>

                                <!-- Status -->
                                <div>
                                    <label class="flex items-center">
                                        <input type="checkbox" name="is_active" value="1" x-model="formData.is_active" class="rounded border-gray-300 dark:border-gray-700 text-blue-600 focus:ring-blue-500">
                                        <span class="ml-2 text-sm font-medium text-gray-700 dark:text-gray-300">Active</span>
                                    </label>
                                </div>
                            </div>

                            <!-- Right Column -->
                            <div class="space-y-4">
                                <!-- Image -->
                                <div>
                                    <label for="image" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Profile Image</label>
                                    <input type="file" name="image" id="image" accept="image/*" @change="previewImage($event)" class="w-full px-3 py-2 bg-white dark:bg-gray-900 border border-gray-300 dark:border-gray-700 text-gray-900 dark:text-gray-100 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                    
                                    <!-- Image Preview -->
                                    <div x-show="imagePreview" class="mt-2">
                                        <img :src="imagePreview" alt="Preview" class="w-20 h-20 object-cover rounded-lg">
                                    </div>
                                </div>

                                <!-- Description -->
                                <div>
                                    <label for="description" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Description</label>
                                    <textarea name="description" id="description" x-model="formData.description" rows="3" maxlength="500" class="w-full px-3 py-2 bg-white dark:bg-gray-900 border border-gray-300 dark:border-gray-700 text-gray-900 dark:text-gray-100 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"></textarea>
                                </div>

                                <!-- Specialties -->
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Specialties</label>
                                    <div class="space-y-2">
                    <template x-for="(specialty, index) in formData.specialties" :key="index">
                                            <div class="flex items-center space-x-2">
                        <input type="text" :name="'specialties[' + index + ']'" x-model="formData.specialties[index]" placeholder="e.g., Hair cutting, Beard trimming" class="flex-1 px-3 py-2 bg-white dark:bg-gray-900 border border-gray-300 dark:border-gray-700 text-gray-900 dark:text-gray-100 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                                <button type="button" @click="removeSpecialty(index)" class="p-2 text-red-600 hover:text-red-800 dark:text-red-400 dark:hover:text-red-300">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                                    </svg>
                                                </button>
                                            </div>
                                        </template>
                                        <button type="button" @click="addSpecialty()" class="w-full px-3 py-2 border-2 border-dashed border-gray-300 dark:border-gray-700 rounded-lg text-gray-600 dark:text-gray-300 hover:border-blue-500 hover:text-blue-600 dark:hover:text-blue-300 transition-colors duration-200">+ Add Specialty</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Modal Footer -->
                        <div class="mt-6 flex flex-col sm:flex-row sm:justify-end space-y-2 sm:space-y-0 sm:space-x-3">
                            <button type="button" @click="closeModal()" class="w-full sm:w-auto px-4 py-2 bg-gray-200 hover:bg-gray-300 dark:bg-gray-700 dark:hover:bg-gray-600 text-gray-800 dark:text-gray-200 text-sm font-medium rounded-lg transition-colors duration-200">Cancel</button>
                            <button type="submit" class="w-full sm:w-auto px-4 py-2 bg-gradient-to-r from-blue-600 to-purple-600 hover:from-blue-700 hover:to-purple-700 text-white text-sm font-medium rounded-lg transition-colors duration-200">
                                <span x-text="modalMode === 'create' ? 'Create Barber' : 'Update Barber'"></span>
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

                <div @click.stop class="relative z-50 inline-block w-full max-w-md sm:max-w-lg md:max-w-xl align-bottom bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-2xl px-4 pt-5 pb-4 text-left overflow-hidden shadow-2xl transform transition-all sm:my-8 sm:align-middle sm:p-6" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100" x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100" x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95">
                    
                    <div class="flex items-center justify-between mb-6">
                        <h3 class="text-lg leading-6 font-medium text-gray-900 dark:text-gray-100">Barber Details</h3>
                        <button type="button" @click="closeViewModal()" class="text-gray-400 hover:text-gray-600 dark:text-gray-500 dark:hover:text-gray-300">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                            </svg>
                        </button>
                    </div>

                    <div x-show="viewingBarber" class="space-y-6">
                        <!-- Profile Image -->
                        <div class="flex justify-center">
                            <div class="w-32 h-32 rounded-full overflow-hidden bg-gray-200 dark:bg-gray-700">
                                <template x-if="viewingBarber.image">
                                    <img :src="'/storage/' + viewingBarber.image" :alt="viewingBarber.name" class="w-full h-full object-cover">
                                </template>
                                <template x-if="!viewingBarber.image">
                                    <div class="w-full h-full bg-gradient-to-br from-blue-500 to-purple-600 flex items-center justify-center">
                                        <svg class="w-12 h-12 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                        </svg>
                                    </div>
                                </template>
                            </div>
                        </div>

                        <!-- Basic Info -->
                        <div class="text-center">
                            <h4 class="text-xl font-semibold text-gray-900 dark:text-gray-100" x-text="viewingBarber.name"></h4>
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium mt-2" :class="viewingBarber.is_active ? 'bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-300' : 'bg-red-100 text-red-800 dark:bg-red-900/30 dark:text-red-300'" x-text="viewingBarber.is_active ? 'Active' : 'Inactive'"></span>
                        </div>

                        <!-- Contact Info -->
                        <div class="grid grid-cols-1 gap-4 text-gray-700 dark:text-gray-300">
                            <div x-show="viewingBarber.email">
                                <label class="block text-sm font-medium text-gray-500 dark:text-gray-400">Email</label>
                                <p class="mt-1 text-sm" x-text="viewingBarber.email"></p>
                            </div>
                            
                            <div x-show="viewingBarber.phone">
                                <label class="block text-sm font-medium text-gray-500 dark:text-gray-400">Phone</label>
                                <p class="mt-1 text-sm" x-text="viewingBarber.phone"></p>
                            </div>
                            
                            <div>
                                <label class="block text-sm font-medium text-gray-500 dark:text-gray-400">Experience</label>
                                <p class="mt-1 text-sm" x-text="viewingBarber.experience_years + ' years'"></p>
                            </div>
                            
                            <div x-show="viewingBarber.description">
                                <label class="block text-sm font-medium text-gray-500 dark:text-gray-400">Description</label>
                                <p class="mt-1 text-sm" x-text="viewingBarber.description"></p>
                            </div>
                            
                            <div x-show="viewingBarber.specialties && viewingBarber.specialties.length > 0">
                                <label class="block text-sm font-medium text-gray-500 dark:text-gray-400">Specialties</label>
                                <div class="mt-1 flex flex-wrap gap-2">
                                    <template x-for="specialty in viewingBarber.specialties" :key="specialty">
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800 dark:bg-blue-900/30 dark:text-blue-300" x-text="specialty"></span>
                                    </template>
                                </div>
                            </div>
                        </div>

                        <!-- Action Buttons -->
                        <div class="flex space-x-3">
                            <button @click="editBarber(viewingBarber.id); closeViewModal()" class="flex-1 px-4 py-2 bg-gradient-to-r from-blue-600 to-purple-600 hover:from-blue-700 hover:to-purple-700 text-white text-sm font-medium rounded-lg transition-colors duration-200">Edit Barber</button>
                            <button @click="confirmDelete(viewingBarber.id, viewingBarber.name); closeViewModal()" class="flex-1 px-4 py-2 bg-red-600 hover:bg-red-700 text-white text-sm font-medium rounded-lg transition-colors duration-200">Delete Barber</button>
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
                            <h3 class="text-lg leading-6 font-medium text-gray-900 dark:text-gray-100">Delete Barber</h3>
                            <div class="mt-2">
                                <p class="text-sm text-gray-600 dark:text-gray-300">Are you sure you want to delete <span x-text="deleteBarberName" class="font-medium"></span>? This action cannot be undone.</p>
                            </div>
                        </div>
                    </div>
                    <div class="mt-5 sm:mt-4 sm:flex sm:flex-row-reverse">
                        <form :action="'/barbers/' + deleteBarberId" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="w-full inline-flex justify-center rounded-lg border border-transparent shadow-sm px-4 py-2 bg-red-600 text-base font-medium text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 sm:ml-3 sm:w-auto sm:text-sm">Delete</button>
                        </form>
                        <button type="button" @click="closeDeleteModal()" class="mt-3 w-full inline-flex justify-center rounded-lg border border-gray-300 dark:border-gray-700 shadow-sm px-4 py-2 bg-white dark:bg-gray-900 text-base font-medium text-gray-700 dark:text-gray-200 hover:bg-gray-50 dark:hover:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:mt-0 sm:w-auto sm:text-sm">Cancel</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function barberCrud() {
            return {
                showModal: false,
                showViewModal: false,
                showDeleteModal: false,
                modalMode: 'create', // 'create' or 'edit'
                editingBarber: null,
                viewingBarber: null,
                deleteBarberId: null,
                deleteBarberName: '',
                imagePreview: null,
                formData: {
                    name: '',
                    email: '',
                    phone: '',
                    description: '',
                    experience_years: 0,
                    specialties: [''],
                    is_active: true
                },
                filters: {
                    search: @json(request('search')) || '',
                    status: @json(request('status')) || '',
                    experience: @json(request('experience')) || ''
                },
                prefillOld() {
                    this.formData.name = @json(old('name')) || '';
                    this.formData.email = @json(old('email')) || '';
                    this.formData.phone = @json(old('phone')) || '';
                    this.formData.description = @json(old('description')) || '';
                    this.formData.experience_years = Number(@json(old('experience_years'))) || 0;
                    const oldSpecs = @json(old('specialties')) || [];
                    this.formData.specialties = Array.isArray(oldSpecs) && oldSpecs.length ? oldSpecs : [''];
                    this.formData.is_active = @json(old('is_active', '1')) === '1' ? true : false;
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
                            this.updateGrid(page);
                        }
                    });
                },
                openCreateModal() {
                    this.modalMode = 'create';
                    this.resetForm();
                    this.showModal = true;
                },

                async editBarber(barberId) {
                    try {
                        const response = await fetch(`/barbers/${barberId}`);
                        const barber = await response.json();
                        
                        this.modalMode = 'edit';
                        this.editingBarber = barber;
                        this.formData = {
                            name: barber.name || '',
                            email: barber.email || '',
                            phone: barber.phone || '',
                            description: barber.description || '',
                            experience_years: barber.experience_years || 0,
                            specialties: barber.specialties?.length ? barber.specialties : [''],
                            is_active: barber.is_active
                        };
                        
                        if (barber.image) {
                            this.imagePreview = `/storage/${barber.image}`;
                        }
                        
                        this.showModal = true;
                    } catch (error) {
                        console.error('Error fetching barber:', error);
                        alert('Error loading barber data');
                    }
                },

                async viewBarber(barberId) {
                    try {
                        const response = await fetch(`/barbers/${barberId}`);
                        const barber = await response.json();
                        this.viewingBarber = barber;
                        this.showViewModal = true;
                    } catch (error) {
                        console.error('Error fetching barber:', error);
                        alert('Error loading barber data');
                    }
                },

                confirmDelete(barberId, barberName) {
                    this.deleteBarberId = barberId;
                    this.deleteBarberName = barberName;
                    this.showDeleteModal = true;
                },

                closeModal() {
                    this.showModal = false;
                    this.resetForm();
                },

                closeViewModal() {
                    this.showViewModal = false;
                    this.viewingBarber = null;
                },

                closeDeleteModal() {
                    this.showDeleteModal = false;
                    this.deleteBarberId = null;
                    this.deleteBarberName = '';
                },

                resetForm() {
                    this.formData = {
                        name: '',
                        email: '',
                        phone: '',
                        description: '',
                        experience_years: 0,
                        specialties: [''],
                        is_active: true
                    };
                    this.editingBarber = null;
                    this.imagePreview = null;
                },

                addSpecialty() {
                    this.formData.specialties.push('');
                },

                removeSpecialty(index) {
                    if (this.formData.specialties.length > 1) {
                        this.formData.specialties.splice(index, 1);
                    }
                },

                previewImage(event) {
                    const file = event.target.files[0];
                    if (file) {
                        const reader = new FileReader();
                        reader.onload = (e) => {
                            this.imagePreview = e.target.result;
                        };
                        reader.readAsDataURL(file);
                    }
                },

                async updateGrid(page = null) {
                    try {
                        const params = new URLSearchParams();
                        if (this.filters.search) params.set('search', this.filters.search);
                        if (this.filters.status) params.set('status', this.filters.status);
                        if (this.filters.experience) params.set('experience', this.filters.experience);
                        if (page) params.set('page', page);
                        const url = `${window.location.pathname}?${params.toString()}`;
                        const res = await fetch(url, { headers: { 'X-Requested-With': 'XMLHttpRequest' } });
                        const html = await res.text();
                        const doc = new DOMParser().parseFromString(html, 'text/html');
                        const newGrid = doc.querySelector('#barbersGrid');
                        const newPagination = doc.querySelector('#paginationContainer');
                        const grid = document.querySelector('#barbersGrid');
                        const pagination = document.querySelector('#paginationContainer');
                        if (newGrid && grid) grid.innerHTML = newGrid.innerHTML;
                        if (pagination) {
                            if (newPagination) pagination.innerHTML = newPagination.innerHTML; else pagination.innerHTML = '';
                        } else if (newPagination && grid) {
                            grid.insertAdjacentHTML('afterend', newPagination.outerHTML);
                        }
                        window.history.pushState({}, '', url);
                    } catch (e) {
                        console.error('Failed to update grid', e);
                    }
                },

                resetFilters() {
                    this.filters.search = '';
                    this.filters.status = '';
                    this.filters.experience = '';
                    this.updateGrid();
                },
            }
        }
    </script>

    <style>
        [x-cloak] { display: none !important; }
        .line-clamp-2 {
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
    </style>
</x-layouts.app>