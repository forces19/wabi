      <nav class="navbar navbar-default">
        <div class="container-fluid">
          <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed"
                    data-toggle="collapse"
                    data-target="#bs-example-navbar-collapse-1"
                    aria-expanded="false">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="{{ url('/') }}">AKADEMIK SMA-BI</a>
          </div>
          <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav navbar-right">
              {{-- Siswa --}}
              @if (Auth::check())
                @if (!empty($halaman) && $halaman == 'siswa')
                  <li class="active"><a href="{{ url('siswa') }}">Siswa <span class="sr-only">(current)</span></a></li>
                @else
                  <li><a href="{{ url('siswa') }}">Siswa</a></li>
                @endif
              @endif

              {{-- Kelas --}}
              @if (Auth::check())
                @if (!empty($halaman) && $halaman == 'kelas')
                  <li class="active"><a href="{{ url('kelas') }}">Kelas <span class="sr-only">(current)</span></a></li>
                @else
                  <li><a href="{{ url('kelas') }}">Kelas</a></li>
                @endif
              @endif

              {{-- About --}}
              @if (!empty($halaman) && $halaman == 'about')
                <li class="active"><a href="{{ url('about') }}">About <span class="sr-only">(current)</span></a></li>
              @else
                <li><a href="{{ url('about') }}">About</a></li>
              @endif

              {{-- User --}}
                @if (!empty($halaman) && $halaman == 'user')
                  <li class="active"><a href="{{ url('user') }}">User <span class="sr-only">(current)</span></a></li>
                @else
                  <li><a href="{{ url('user') }}">User</a></li>
                @endif
            </ul>

            {{-- Link Login --}}
            <ul class="nav navbar-nav navbar-right">
              @if (Auth::check())
                <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>

                            <ul class="dropdown-menu" role="menu">
                                <li><a href="{{ url('/logout') }}"><i class="fa fa-btn fa-sign-out"></i>Logout</a></li>
                            </ul>
                        </li>
              @else
                <li><a href="{{ url('login') }}">Login</a></li>
              @endif
            </ul>
          </div><!-- /.navbar-collapse -->
        </div><!-- /.container-fluid -->
      </nav>