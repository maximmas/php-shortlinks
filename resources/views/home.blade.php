@extends('layouts.app')

@section('content')

    <main class="h-full w-full relative overflow-y-auto">

        <h1 class="text-3xl font-bold">Online short link service</h1>

        <form action="<?php echo route('links.create'); ?>"
              method="POST"
              class="form-add flex-col w-full">
            @csrf
            <input
                name="url"
                type="url"
                class="block-content mb-4 bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-cyan-600 focus:border-cyan-600 block w-96 pl-5 p-2.5"
                placeholder="Insert URL here"
            />
            <button type="submit" class="btn btn-blue text-base mt-2 mb-8 mr-4">Add</button>
        </form>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li class="text-base">{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <h2 class="text-2xl font-bold mb-2">Saved Links</h2>
        @if($links)
            <ul>
                @foreach($links as $link)
                    <li class="mb-4">
                        <p class="font-bold">
                            Original Link:
                            <a class="font-normal  text-blue-700"
                               href="{{ $link['origin_url'] }}"
                               target="_blank"
                            >
                                {{ $link['origin_url'] }}
                            </a>
                        </p>
                        <p class="font-bold mb-2">
                            Short Link:
                            <a class="font-normal text-blue-700"
                               href="{{ url('/l-') . $link['hash'] }}"
                               target="_blank"
                            >
                                {{ url('/l-') . $link['hash'] }}
                            </a>
                        </p>
                        <a href="<?php echo route('links.delete', ['id' => $link['id']])?>"
                           class="btn btn-red text-base mt-2 mb-8 mr-4">
                            Delete
                        </a>
                    </li>
                @endforeach

            </ul>
        @endif
    </main>

@endsection
