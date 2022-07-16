<div class="col-md-12">
    @include('livewire.widgets.admin.header.more-options')
    <div class="separator mb-5"></div>
    <div class="border" style="border-color: grey;">
        <div class="card-body scrollbar scroller" style="overflow-x: auto">
            <style>
                .tree li {
                    list-style-type: none;
                    margin: 0;
                    padding: 10px 5px 0 5px;
                    position: relative
                }

                .tree li::before,
                .tree li::after {
                    content: '';
                    left: -20px;
                    position: absolute;
                    right: auto
                }

                .tree li::before {
                    border-left: 2px solid #737373;
                    bottom: 50px;
                    height: 100%;
                    top: 0;
                    width: 1px
                }

                .tree li::after {
                    border-top: 2px solid #737373;
                    height: 20px;
                    top: 25px;
                    width: 25px
                }

                .tree li span {
                    -moz-border-radius: 5px;
                    -webkit-border-radius: 5px;
                    border: 2px solid #737373;
                    border-radius: 3px;
                    display: inline-block;
                    padding: 3px 8px;
                    text-decoration: none;
                    cursor: pointer;
                    color: #737373;
                    /*text-decoration: none;*/
                }

                .tree li span:hover {
                    border: 2px solid #e7e7e7;
                    background: #1D477A;
                }

                .tree > ul > li::before,
                .tree > ul > li::after {
                    border: 0
                }

                .tree li:last-child::before {
                    height: 27px
                }


                .tree li span a {
                    color: #737373;
                    width: 100%;
                    height: 100%;
                }

                .tree li span a:hover {
                    color: #e7e7e7 !important;
                }


                [aria-expanded="false"] > .expanded,
                [aria-expanded="true"] > .collapsed {
                    display: none;
                }

            </style>

            <div class="tree ">
                <ul>

                    <li>
                        <span>
                            <a data-toggle="collapse" href="#Web"
                               aria-expanded="true" aria-controls="Web">
                                <i class="collapsed"><i class="fas fa-folder"></i></i>
                                <i class="expanded"><i class="far fa-folder-open"></i></i>
                                Regiones
                            </a>
                        </span>
                        <div id="Web" class="collapse show">
                            <ul>
                                @foreach ($results as $region)
                                    <li>
                                    <span>
                                        <a data-toggle="collapse"
                                           href="#region-{{ $region->id }}" aria-expanded="false"
                                           aria-controls="region-{{ $region->id }}">
                                            <i class="collapsed"><i class="fas fa-folder"></i></i>
                                            <i class="expanded"><i class="far fa-folder-open"></i></i>
                                            {{ $region->name }}
                                        </a>
                                    </span>
                                        <ul>
                                            <div id="region-{{ $region->id }}" class="collapse">
                                                @foreach ($region->provinces as $province)
                                                    <li>
                                                        <span>
                                                            <a
                                                                data-toggle="collapse"
                                                                href="#province-{{ $province->id }}"
                                                                aria-expanded="false"
                                                                aria-controls="province-{{ $province->id }}">
                                                                <i class="collapsed"><i class="fas fa-folder"></i></i>
                                                                <i class="expanded"><i
                                                                        class="far fa-folder-open"></i></i>
                                                                {{ $province->name }}
                                                                </a>
                                                        </span>
                                                        <ul>
                                                            <div id="province-{{ $province->id }}" class="collapse">
                                                                @foreach ($province->towns as $town)
                                                                    <li>
                                                                        <span>
                                                                            <i class="far fa-file"></i><a
                                                                                href="#!"> {{ $town->name }}</a>
                                                                        </span>
                                                                    </li>
                                                                @endforeach
                                                            </div>
                                                        </ul>
                                                    </li>
                                                @endforeach
                                            </div>
                                        </ul>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </li>
                </ul>

            </div>

        </div>
    </div>
</div>


{{--<div class="tree ">--}}
{{--    <ul>--}}

{{--        <li>--}}
{{--                        <span>--}}
{{--                            <a style="color:#737373; text-decoration:none;" data-toggle="collapse" href="#Web"--}}
{{--                               aria-expanded="true" aria-controls="Web">--}}
{{--                                <i class="collapsed"><i class="fas fa-folder"></i></i>--}}
{{--                                <i class="expanded"><i class="far fa-folder-open"></i></i> Web--}}
{{--                            </a>--}}
{{--                        </span>--}}
{{--            <div id="Web" class="collapse show">--}}
{{--                <ul>--}}
{{--                    <li>--}}
{{--                        <span><i class="far fa-file"></i><a href="#!"> Link 1</a></span>--}}
{{--                    </li>--}}


{{--                    <li>--}}
{{--                                    <span>--}}
{{--                                        <a style="color:#737373; text-decoration:none;" data-toggle="collapse"--}}
{{--                                           href="#Page2" aria-expanded="false" aria-controls="Page2">--}}
{{--                                            <i class="collapsed"><i class="fas fa-folder"></i></i>--}}
{{--                                            <i class="expanded"><i class="far fa-folder-open"></i></i> Page 2--}}
{{--                                        </a>--}}
{{--                                    </span>--}}
{{--                        <ul>--}}
{{--                            <div id="Page2" class="collapse">--}}
{{--                                <li>--}}
{{--                                                <span>--}}
{{--                                                    <a style="color:#737373; text-decoration:none;"--}}
{{--                                                       data-toggle="collapse" href="#folder1" aria-expanded="false"--}}
{{--                                                       aria-controls="folder1">--}}
{{--                                                        <i class="collapsed"><i class="fas fa-folder"></i></i>--}}
{{--                                                        <i class="expanded"><i class="far fa-folder-open"></i></i> Folder 1--}}
{{--                                                        </a>--}}
{{--                                                </span>--}}
{{--                                    <ul>--}}
{{--                                        <div id="folder1" class="collapse">--}}
{{--                                            <li>--}}
{{--                                                            <span>--}}
{{--                                                                <i class="far fa-file"></i><a href="#!"> Link 1</a>--}}
{{--                                                            </span>--}}
{{--                                            </li>--}}

{{--                                        </div>--}}
{{--                                    </ul>--}}
{{--                                </li>--}}

{{--                                <li><span><i class="far fa-file"></i><a href="#!"> Link</a></span></li>--}}

{{--                            </div>--}}
{{--                        </ul>--}}
{{--                    </li>--}}

{{--                </ul>--}}
{{--            </div>--}}
{{--        </li>--}}
{{--    </ul>--}}

{{--</div>--}}
