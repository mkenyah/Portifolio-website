@extends('layouts.admin')

@section('content')
<div class="bg-white rounded-lg shadow-md p-6">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Contact Message Details</h1>
        <a href="{{ route('admin.contact-messages.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
            Back to Messages
        </a>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
        <div>
            <h3 class="text-lg font-semibold text-gray-800 mb-4">Sender Information</h3>
            <div class="space-y-3">
                <div>
                    <label class="block text-sm font-medium text-gray-700">Name</label>
                    <p class="mt-1 text-sm text-gray-900">{{ $contactMessage->name }}</p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Email</label>
                    <p class="mt-1 text-sm text-gray-900">{{ $contactMessage->email }}</p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Subject</label>
                    <p class="mt-1 text-sm text-gray-900">{{ $contactMessage->subject }}</p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Sent At</label>
                    <p class="mt-1 text-sm text-gray-900">{{ $contactMessage->created_at->format('M d, Y H:i') }}</p>
                </div>
            </div>
        </div>

        <div>
            <h3 class="text-lg font-semibold text-gray-800 mb-4">Message Content</h3>
            <div class="bg-gray-50 p-4 rounded-lg">
                <p class="text-sm text-gray-900 whitespace-pre-wrap">{{ $contactMessage->message }}</p>
            </div>
        </div>
    </div>

    <div class="flex justify-end space-x-3">
        <form action="{{ route('admin.contact-messages.destroy', $contactMessage) }}" method="POST" class="inline">
            @csrf
            @method('DELETE')
            <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded" onclick="return confirm('Are you sure you want to delete this message?')">
                Delete Message
            </button>
        </form>
    </div>
</div>
@endsection
