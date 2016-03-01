<div class="container">
    <h2>You are in the View: application/view/song/index.php (everything in this box comes from that file)</h2>
    <!-- add song form -->
    <div class="box">
        <h3>Add a song</h3>
        <form action="<?php echo URL; ?>songs/addsong" method="POST">
            <label>Artist</label>
            <input type="text" name="artist" value="" required />
            <label>Track</label>
            <input type="text" name="track" value="" required />
            <label>Link</label>
            <input type="text" name="link" value="" />
            <input type="submit" name="submit_add_song" value="Submit" />
        </form>
    </div>
    <!-- main content output -->
    <div class="box">
        <h3>Amount of songs (data from second model)</h3>
        <div>
            <?php echo $amount_of_songs; ?>
        </div>
        <h3>Amount of songs (via AJAX)</h3>
        <div>
            <button id="javascript-ajax-button">Click here to get the amount of songs via Ajax (will be displayed in #javascript-ajax-result-box)</button>
            <div id="javascript-ajax-result-box"></div>
        </div>
        <h3>List of songs (data from first model)</h3>
        <table>
            <thead style="background-color: #ddd; font-weight: bold;">
                <tr>
                    <td>Id</td>
                    <td>Artist</td>
                    <td>Track</td>
                    <td>Link</td>
                    <td>DELETE</td>
                    <td>EDIT</td>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($songs as $song) { ?>
                <tr>
                    <td><?php if (isset($song->id)) echo htmlspecialchars($song->id, ENT_QUOTES, 'UTF-8'); ?></td>
                    <td><?php if (isset($song->artist)) echo htmlspecialchars($song->artist, ENT_QUOTES, 'UTF-8'); ?></td>
                    <td><?php if (isset($song->track)) echo htmlspecialchars($song->track, ENT_QUOTES, 'UTF-8'); ?></td>
                    <td>
                        <?php if (isset($song->link)) { ?>
                        <a href="<?php echo htmlspecialchars($song->link, ENT_QUOTES, 'UTF-8'); ?>"><?php echo htmlspecialchars($song->link, ENT_QUOTES, 'UTF-8'); ?></a>
                        <?php } ?>
                    </td>
                    <td><a href="<?php echo URL . 'songs/deletesong/' . htmlspecialchars($song->id, ENT_QUOTES, 'UTF-8'); ?>">delete</a></td>
                    <td><a href="<?php echo URL . 'songs/editsong/' . htmlspecialchars($song->id, ENT_QUOTES, 'UTF-8'); ?>">edit</a></td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>


<form id="formSong" class="row">

    <h1>Este es el que se comunica con ajax</h1>

    <div class="col-md-4">
        <div class="form-group">
            <input type="text" placeholder="artista" id="txtArtist" name="txtArtist" class="form-control">
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <input type="text" placeholder="Track" id="txtTrack" name="txtTrack" class="form-control">
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <input type="text" placeholder="Link" id="txtLink" name="txtLink" class="form-control">
        </div>
    </div>
</form>

<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            <button type="button" id="btnGuardarCancion" class="btn btn-success btn-block">
                Guardar
            </button>
        </div>
    </div>
</div>


<div class="row">

    <div class="col-md-12">

        <table class="table table-hover" id="tblSongs">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Artist</th>
                    <th>Track</th>
                    <th>Link</th>
                    <th>DELETE</th>
                    <th>EDIT</th>
                </tr>
            </thead>
            <tbody id="tbodySongs">

            </tbody>
        </table>

    </div>

</div>


<script type="text/x-tmpl" id="tmpl-data-song">

    <tr>
        <td>{%=o.id%}</td>
        <td>{%=o.artist%}</td>
        <td>{%=o.track%}</td>
        <td>
            <a href="{%=o.link%}">{%=o.link%}</a>
        </td>
        <td>
            <a href="songs/deletesong/{%=o.id%}" class="btn btn-block btn-primary">Borrar</a>
        </td>
        <td>
            <a href="songs/editsong/{%=o.id%}" class="btn btn-block btn-primary">Editar</a>
        </td>
    </tr>

</script>

<?php

$js = '<script src="'.URL.'js/pages/songsAjax.js" type="text/javascript"></script>';


?>