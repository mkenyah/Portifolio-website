@extends('layouts.admin')

@section('content')
<div class="space-y-6">
    <div class="flex justify-between items-center">
        <h1 class="text-2xl font-bold text-gray-900">Comments Management</h1>
    </div>

    <div class="bg-white rounded-lg shadow overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-200">
            <h2 class="text-lg font-semibold text-gray-900">All Comments</h2>
        </div>
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Comment</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider hidden md:table-cell">Project</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider hidden lg:table-cell">Date</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($comments as $comment)
                    <tr>
                        <td class="px-6 py-4">
                            <div class="text-sm text-gray-900">{{ Str::limit($comment->message, 100) }}</div>
                            <div class="md:hidden text-xs text-gray-500 mt-1">
                                On {{ $comment->project->name }} • {{ $comment->created_at->format('M d, Y') }}
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap hidden md:table-cell">
                            <div class="text-sm font-medium text-gray-900">{{ $comment->project->name }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap hidden lg:table-cell">
                            <div class="text-sm text-gray-500">{{ $comment->created_at->format('M d, Y') }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                            <div class="flex flex-col space-y-1 md:flex-row md:space-y-0 md:space-x-2">
                                <button onclick="editComment({{ $comment->id }}, '{{ addslashes($comment->message) }}')" class="text-indigo-600 hover:text-indigo-900">Edit</button>
                                <form action="{{ route('admin.comments.destroy', $comment) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-900" onclick="return confirm('Are you sure?')">Delete</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="px-6 py-4 text-center text-gray-500">No comments found</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="px-6 py-4 border-t border-gray-200">
            {{ $comments->links() }}
        </div>
    </div>
</div>

<!-- Edit Comment Modal -->
<div id="editCommentModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden">
    <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
        <div class="mt-3">
            <h3 class="text-lg font-medium text-gray-900 mb-4">Edit Comment</h3>
            <form id="editCommentForm" method="POST">
                @csrf
                @method('PUT')
                <textarea name="content" id="editCommentContent" rows="4" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required></textarea>
                <div class="flex justify-end mt-4">
                    <button type="button" onclick="closeEditModal()" class="mr-2 px-4 py-2 text-gray-500 bg-gray-200 rounded-md hover:bg-gray-300">Cancel</button>
                    <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
function editComment(id, content) {
    document.getElementById('editCommentForm').action = '/admin/comments/' + id;
    document.getElementById('editCommentContent').value = content;
    document.getElementById('editCommentModal').classList.remove('hidden');
}

function closeEditModal() {
    document.getElementById('editCommentModal').classList.add('hidden');
}
</script>
@endsection
