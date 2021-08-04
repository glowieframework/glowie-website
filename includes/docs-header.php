<section class="docs-header">
    <div class="container">
        <a href="docs"><h1>Documentation</h1></a>
        <a class="version dropdown-toggle">
            version <strong><?=$version?></strong>
            <?=$version == $lastVersion ? '<span>(latest)</span>' : ''?>
        </a>
        <div class="dropdown-menu">
            <?php foreach(array_reverse($versionList) as $version):?>
                <?php $version = str_replace('documentation/', '', $version); ?>
                <a href="docs/<?=$version?>" class="dropdown-item">
                    version <strong><?=$version?></strong>
                    <?=$version == $lastVersion ? '<span>(latest)</span>' : ''?>
                </a>
            <?php endforeach;?>
        </div>
    </div>
</section>