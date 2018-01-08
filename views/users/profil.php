<section class="hero is-black welcome is-black">
    <div class="hero-body">
        <h1 class="title">
            Bonjour <?php echo $_SESSION['pseudo']; ?> !
        </h1>
        <h2 class="subtitle">
            J'espère que tu passes une bonne journée !
        </h2>
    </div>
</section>
<br />
<div class="columns">


    <?php if($_SESSION['guild'] !== false) { ?>
        <br />
        <section class="tile is-centered">
            <div class="card">
                <div class="card-content">
                    <div class="content">
                        <p class="is-medium">
                            Guilde : <?php echo $_SESSION['guild']; ?>
                        </p>
                    </div>
                </div>
            </div>
        </section>
    <?php } ?>
</div>

</div>

<div class="tile is-ancestor">
    <div class="tile is-4 is-vertical is-parent">
        <div class="tile is-child box">
            <article class="tile is-child notification is-black">
                <p class="title">Informations sur l'utilisateur</p>
                <div class="column is-10">
                    <div class="tile is-centered">
                        <figure class="image is-256x256 is-centered">
                            <img src="../images/fond/3.png">
                        </figure>
                    </div>
                </div>
                <p class="is-medium">
                    Pseudo : <?php echo $_SESSION['pseudo']; ?>
                </p>
                <p>
                    E-Mail : <?php echo $_SESSION['mail']; ?>
                </p>
            </article>
        </div>
        <div class="tile is-child box ">
            <div class="tile is-parent">
                <!-- <div class="tile is-child box"> -->
                    <article class="tile is-child notification is-black">
                        <p class="title">Commentaires sur l'utilisateur</p>
                        <article class="media">
                            <figure class="media-left">
                                <p class="image is-64x64">
                                    <img src="https://bulma.io/images/placeholders/128x128.png">
                                </p>
                            </figure>
                            <div class="media-content">
                                <div class="content">
                                    <p>
                                        <strong>Barbara Middleton</strong>
                                        <br>
                                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis porta eros lacus, nec ultricies elit blandit non. Suspendisse pellentesque mauris sit amet dolor blandit rutrum. Nunc in tempus turpis.
                                        <br>
                                        <small><a>Like</a> · <a>Reply</a> · 3 hrs</small>
                                    </p>
                                </div>

                                <article class="media">
                                    <figure class="media-left">
                                        <p class="image is-48x48">
                                            <img src="https://bulma.io/images/placeholders/96x96.png">
                                        </p>
                                    </figure>
                                    <div class="media-content">
                                        <div class="content">
                                            <p>
                                                <strong>Sean Brown</strong>
                                                <br>
                                                Donec sollicitudin urna eget eros malesuada sagittis. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Aliquam blandit nisl a nulla sagittis, a lobortis leo feugiat.
                                                <br>
                                                <small><a>Like</a> · <a>Reply</a> · 2 hrs</small>
                                            </p>
                                        </div>

                                        <article class="media">
                                            Vivamus quis semper metus, non tincidunt dolor. Vivamus in mi eu lorem cursus ullamcorper sit amet nec massa.
                                        </article>

                                        <article class="media">
                                            Morbi vitae diam et purus tincidunt porttitor vel vitae augue. Praesent malesuada metus sed pharetra euismod. Cras tellus odio, tincidunt iaculis diam non, porta aliquet tortor.
                                        </article>
                                    </div>
                                </article>

                                <article class="media">
                                    <figure class="media-left">
                                        <p class="image is-48x48">
                                            <img src="https://bulma.io/images/placeholders/96x96.png">
                                        </p>
                                    </figure>
                                    <div class="media-content">
                                        <div class="content">
                                            <p>
                                                <strong>Kayli Eunice </strong>
                                                <br>
                                                Sed convallis scelerisque mauris, non pulvinar nunc mattis vel. Maecenas varius felis sit amet magna vestibulum euismod malesuada cursus libero. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Phasellus lacinia non nisl id feugiat.
                                                <br>
                                                <small><a>Like</a> · <a>Reply</a> · 2 hrs</small>
                                            </p>
                                        </div>
                                    </div>
                                </article>
                            </div>
                        </article>
                        <article class="media">
                            <figure class="media-left">
                                <p class="image is-64x64">
                                    <img src="https://bulma.io/images/placeholders/128x128.png">
                                </p>
                            </figure>
                            <div class="media-content">
                                <div class="field">
                                    <p class="control">
                                        <textarea class="textarea" placeholder="Add a comment..."></textarea>
                                    </p>
                                </div>
                                <div class="field">
                                    <p class="control">
                                        <button class="button">Post comment</button>
                                    </p>
                                </div>
                            </div>
                        </article>
                    </div>
                </div>
            <!-- </div> -->
        </div>

        <div class="tile is-parent">
            <div class="tile is-child box">
                        <article class="tile is-child notification is-dark">
                <p class="title">Stats de l'utilisateur</p>
                <nav class="level is-mobile">
                    <div class="level-item has-text-centered">
                        <div>
                            <p class="heading">Like de runages</p>
                            <p class="title">3,456</p>
                        </div>
                    </div>
                    <div class="level-item has-text-centered">
                        <div>
                            <p class="heading">Dislike de runages</p>
                            <p class="title">123</p>
                        </div>
                    </div>
                    <div class="level-item has-text-centered">
                        <div>
                            <p class="heading">Fans</p>
                            <p class="title">456K</p>
                        </div>
                    </div>
                    <div class="level-item has-text-centered">
                        <div>
                            <p class="heading">Posts</p>
                            <p class="title">789</p>
                        </div>
                    </div>
                </article>
                </nav>

                <br />
                <div class="tile is-ancestor">
                    <div class="tile is-15 is-vertical is-parent">

                        <div class="tile">
                            <div class="content">
                                        <article class="tile is-child notification is-dark">
                                <p class="title">Derniers runages proposés par <?php echo $_SESSION['pseudo']; ?></p>
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam semper diam at erat pulvinar, at pulvinar felis blandit. Vestibulum volutpat tellus diam, consequat gravida libero rhoncus ut. Morbi maximus, leo sit amet vehicula eleifend, nunc dui porta orci, quis semper odio felis ut quam.</p>
                                <p>Suspendisse varius ligula in molestie lacinia. Maecenas varius eget ligula a sagittis. Pellentesque interdum, nisl nec interdum maximus, augue diam porttitor lorem, et sollicitudin felis neque sit amet erat. Maecenas imperdiet felis nisi, fringilla luctus felis hendrerit sit amet. Aenean vitae gravida diam, finibus dignissim turpis. Sed eget varius ligula, at volutpat tortor.</p>
                                <p>Integer sollicitudin, tortor a mattis commodo, velit urna rhoncus erat, vitae congue lectus dolor consequat libero. Donec leo ligula, maximus et pellentesque sed, gravida a metus. Cras ullamcorper a nunc ac porta. Aliquam ut aliquet lacus, quis faucibus libero. Quisque non semper leo.</p>
                            </article>
                            </div>
                        </div>
                    </div>

                    <br />

                    <!-- <div class="tile is-ancestor"> -->
                        <div class="tile is-15 is-vertical is-parent">

                            <div class="tile">
                                <div class="content">
                                            <article class="tile is-child notification is-dark">
                                    <p class="title">Derniers runages regardés par <br /> <?php echo $_SESSION['pseudo']; ?></p>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam semper diam at erat pulvinar, at pulvinar felis blandit. Vestibulum volutpat tellus diam, consequat gravida libero rhoncus ut. Morbi maximus, leo sit amet vehicula eleifend, nunc dui porta orci, quis semper odio felis ut quam.</p>
                                    <p>Suspendisse varius ligula in molestie lacinia. Maecenas varius eget ligula a sagittis. Pellentesque interdum, nisl nec interdum maximus, augue diam porttitor lorem, et sollicitudin felis neque sit amet erat. Maecenas imperdiet felis nisi, fringilla luctus felis hendrerit sit amet. Aenean vitae gravida diam, finibus dignissim turpis. Sed eget varius ligula, at volutpat tortor.</p>
                                    <p>Integer sollicitudin, tortor a mattis commodo, velit urna rhoncus erat, vitae congue lectus dolor consequat libero. Donec leo ligula, maximus et pellentesque sed, gravida a metus. Cras ullamcorper a nunc ac porta. Aliquam ut aliquet lacus, quis faucibus libero. Quisque non semper leo.</p>
                                </article>
                                </div>
                            </div>
                        </div>




                <!-- </div> -->
            </div>
        </div>
    </div>
</div>
