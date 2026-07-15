<div class="space-y-5 rounded-[24px] border border-rose-200 bg-white/85 p-6 shadow-sm">
    <div class="input-group" style="margin-bottom: 0;">
        <label class="mb-2 block text-sm font-semibold text-rose-700">Question title</label>
        <input type="text" wire:model="title" name="title" class="w-full rounded-2xl border border-rose-200 px-4 py-3 focus:border-rose-400 focus:outline-none" />
    </div>

    <div class="input-group" style="margin-bottom: 0;">
        <label class="mb-2 block text-sm font-semibold text-rose-700">Description</label>
        <textarea wire:model="description" name="description" rows="3" class="w-full rounded-2xl border border-rose-200 px-4 py-3 focus:border-rose-400 focus:outline-none"></textarea>
    </div>

    <div class="input-group" style="margin-bottom: 0;">
        <label class="mb-2 block text-sm font-semibold text-rose-700">Status</label>
        <select wire:model="status" name="status" class="w-full rounded-2xl border border-rose-200 px-4 py-3 focus:border-rose-400 focus:outline-none">
            <option value="draft">Draft</option>
            <option value="published">Published</option>
        </select>
    </div>

    <div class="rounded-2xl border border-rose-100 bg-rose-50/70 p-4">
        <div class="mb-3 flex items-center justify-between">
            <h3 class="text-sm font-semibold text-rose-700">Answer options</h3>
            <button type="button" wire:click="addOption" class="rounded-full bg-rose-500 px-3 py-1 text-sm font-medium text-white">Add option</button>
        </div>
        @foreach($options as $index => $option)
            <div class="mb-3 flex items-center gap-2">
                <input type="text" wire:model="options.{{ $index }}.option_text" name="options[{{ $index }}][option_text]" class="flex-1 rounded-2xl border border-rose-200 px-4 py-3 focus:border-rose-400 focus:outline-none" placeholder="Option {{ $index + 1 }}" />
                @if(count($options) > 2)
                    <button type="button" wire:click="removeOption({{ $index }})" class="rounded-full border border-rose-200 px-3 py-2 text-sm text-rose-600">Remove</button>
                @endif
            </div>
        @endforeach
    </div>

    <label class="flex items-center gap-3 text-sm font-medium text-rose-700">
        <input type="checkbox" wire:model="is_public" name="is_public" value="1" class="h-4 w-4 rounded border-rose-200" />
        Make this question publicly viewable
    </label>
</div>
