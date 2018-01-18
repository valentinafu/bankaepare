<aside class="main-sidebar">
    <section class="sidebar">

        <div class="input-group sidebar-form">
            <input type="text" name="q" class="form-control" placeholder="Search...">
            <span class="input-group-btn">
            <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
            </button>
          </span>
        </div>

        @if((Request::is('subjects/*') || Request::is('exams/*')) && isset($subjects))
            <ul class="sidebar-menu" data-widget="tree">
                @foreach($subjects as $subject)
                    <li><a href="/subjects/{{ $subject->id }}"><span>{{ $subject->name }}</span></a></li>
                @endforeach
            </ul>
        @elseif(Request::is('degrees/*') && isset($degrees))
            <ul class="sidebar-menu" data-widget="tree">
                @foreach($degrees as $degree)
                    <li><a href="/degrees/{{ $degree->id }}"><span>{{ $degree->name }}</span></a></li>
                @endforeach
            </ul>
        @elseif(Request::is('faculties/*') || isset($faculties))
            <ul class="sidebar-menu" data-widget="tree" id="sidebarElements">
                @foreach($faculties as $faculty)
                    <li><a href="/faculties/{{ $faculty->id }}"><span>{{ $faculty->name }}</span></a></li>
                @endforeach
            </ul>
        @endif

    </section>
</aside>