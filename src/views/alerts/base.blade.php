<div x-data="{shown:true}">
  <template x-if="shown">
    <div class="rounded-r-md bg-{{ $color ?? 'blue' }}-100 p-4 border-l-4 border-{{ $color ?? 'blue' }}-400 mb-3">
      <div class="flex">
        @if ($icon ?? false)
            <div class="flex-shrink-0">
                <p class="text-{{ $color ?? 'blue' }}-400">
                    <x-fas>{{ $icon }}</x-fas>
                </p>
            </div>
        @endif
        <div class="ml-3 text-sm leading-5 font-medium text-{{ $color ?? 'blue' }}-800">
            {!! $slot !!}
        </div>
        @if ($dismissable ?? false)
        <div class="ml-auto pl-3">
          <div class="-mx-1.5 -my-1.5">
            <button class="inline-flex rounded-md p-1.5 text-{{ $color ?? 'blue' }}-500 hover:bg-{{ $color ?? 'blue' }}-100 focus:outline-none focus:bg-{{ $color ?? 'blue' }}-100 transition ease-in-out duration-150" @click="shown=false">
              <x-fas>times</x-fas>
            </button>
          </div>
        </div>
        @endif
      </div>
    </div>
  </template>
</div>

