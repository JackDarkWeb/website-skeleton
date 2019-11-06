<? $title_for_site = 'welcome'?>

<h1 class="welcome">Welcome</h1>
<p>C'est la page d'accueil</p>




<? //dd(assets('images.54-512'))?>





<h1>Use of Ajax in the system by example search Google</h1>


<div class="result"></div>
<section class='py-5' id='search-section'>
    <div class='container'>
        <div class='row'>
            <form method="post" action="" id="form-search" class="form-group col-10 offset-1 col-md-8 offset-md-2">
                <div class='row'>
                    <div class='col-md-8'>
                        <div class='row'>
                            <input class="form-control mr-sm-2" type="search" id="search" placeholder="Search" style="width: 800px">


                            <ul class='col-12 list-unstyled mt-5 bg-white' style="display: none">

                            </ul>

                            <div class="text-danger not-found"></div>
                        </div>
                    </div>

                    <button class="btn btn-outline-warning ml-md-2 mt-3 mt-md-0 text-white col-md-3 d-none" type="submit">Recherche</button>
                </div>
            </form>
        </div>
    </div>
</section>

<table class="table" style="display: none">
    <thead class="thead-dark">
    <tr>
        <th scope="col">ID</th>
        <th scope="col">Title</th>
        <th scope="col">Category</th>
        <th scope="col">Created At</th>
    </tr>
    </thead>
    <tbody>
    <tr>
        <th scope="row">1</th>
        <td>Mark</td>
        <td>Otto</td>
        <td>@mdo</td>
    </tr>
    <tr>
        <th scope="row">2</th>
        <td>Jacob</td>
        <td>Thornton</td>
        <td>@fat</td>
    </tr>
    <tr>
        <th scope="row">3</th>
        <td>Larry</td>
        <td>the Bird</td>
        <td>@twitter</td>
    </tr>
    </tbody>
</table>


<h3 style="margin-top: 300px">Use the function <strong>assets</strong> to display ours images in view or insert your css or jquery</h3>


<script src="<?=assets('js.search')?>"></script>


<img src="<?=assets('images.1646617')?>" style="width: 100px"/>
<link rel="stylesheet" href="<?=assets('css.contact')?>"/>

<script src="<?=assets('folder.name_file_without_extension')?>"></script>



