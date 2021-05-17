
@if ($currentUser->hasMedia())
  <img src="{{ $currentUserProfilePic[0]->getUrl('profile') }}" alt="Profile Picture">
  <a class="text-blue-700" href="{{ route('upload') }}">Change</a>
  @else
    <p>No image submitted</p> 
    <a class="text-blue-700"  href="{{ route('upload') }}">Upload</a>
@endif

<p><b>What do you want to do?</b></p>

<div class="space-x-4">
  @can('delete user')
    <div class="inline-block"><a class="text-blue-700"  href="{{ route('users.index') }}" > 
      Show User</a>
    </div>
  @endcan

  @can('publish article','unpublish articles')
    <div class="inline-block">
      <a class="text-blue-700"  href="/articles" > Publish Article</a>
    </div>
  @endcan
  <div class="inline-block">
    <a class="text-blue-700"  href="{{ route('articles.index') }}"> View Article</a>
  </div>

</div>
  










