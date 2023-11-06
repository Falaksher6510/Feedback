<x-app-layout>

<div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="container mt-5">
                        <h2>Feedback Form</h2>
                            <form action="{{ route('feedback.store') }}"  method="post">
                                @csrf
                                <!-- Title -->
                                <div class="mb-3">
                                    <label for="title" class="form-label">Title *</label>
                                        <input type="text" class="form-control" id="title" name="title" required>
                                </div>

                                <!-- Description -->
                                <div class="mb-3">
                                    <label for="description" class="form-label">Description *</label>
                                    <textarea class="form-control" id="description" name="description" rows="4" required></textarea>
                                </div>

                                <!-- Category -->
                                <div class="mb-3">
                                    <label for="category" class="form-label">Category *</label>
                                    <select class="form-select" id="category" name="category" required>
                                        <option value="" disabled selected>Select a category</option>
                                        <option value="Bug Report">Bug Report</option>
                                        <option value="Feature Request">Feature Request</option>
                                        <option value="Improvement">Improvement</option>
                                        <!-- Add more options as needed -->
                                    </select>
                                </div>

                                    <button style="color: black;" type="submit" class="btn btn-primary">Submit Feedback</button>
                            </form>
                    </div>
                </div>
            </div>
        </div>
</div>
</x-app-layout>