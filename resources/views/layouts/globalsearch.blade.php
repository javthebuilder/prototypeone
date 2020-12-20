<li class="d-none d-sm-block">
    <form class="app-search">
        <div class="app-search-box">
            <div class="input-group">

                <input type="text" id="globalsearch" name="search" class="form-control" placeholder="{{$placeholder}}"  value="{{$search}}" autofocus="">

                @include('layouts.hiddeninputs')

                <div class="input-group-append">
                    <button class="btn" type="submit">
                        <i class="fe-search"></i>
                    </button>
                </div>

            </div>
        </div>
    </form>
</li>