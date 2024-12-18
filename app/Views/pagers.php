<style>
    .pagination {
        padding: 1rem;
        display: flex;
        gap: 10px;
        justify-content: center;
    }
    .pagination a {
        padding: 0.5rem 1rem;
        border-radius: 5px;
        border: 1px solid  #696868;
        font-weight: 600;
        color: #696868;
        text-decoration: none;
    }
    .pagination a.active{
        background-color: #696868;
        color: #ffffff;
        border:none;
    }
</style>


<?php $pager->setSurroundCount(2) ?>

<nav aria-label="Page navigation">
    <ul class="pagination">
    <?php if ($pager->hasPrevious()) : ?>
        <li class="items-pages">
            <a class="link-pages" href="<?= $pager->getFirst() ?>" aria-label="<?= lang('Pager.first') ?>">
                <span aria-hidden="true"><?= lang('Pager.first') ?></span>
            </a>
        </li>
        <li class="items-pages">
            <a class="link-pages" href="<?= $pager->getPrevious() ?>" aria-label="<?= lang('Pager.previous') ?>">
                <span aria-hidden="true"><?= lang('Pager.previous') ?></span>
            </a>
        </li>
    <?php endif ?>

    <?php foreach ($pager->links() as $link): ?>
        <li class="items-pages">
            <a class="link-pages <?= $link['active'] ? 'active' : '' ?>" href="<?= $link['uri'] ?>">
                <?= $link['title'] ?>
            </a>
        </li>
    <?php endforeach ?>

    <?php if ($pager->hasNext()) : ?>
        <li class="items-pages">
            <a class="link-pages" href="<?= $pager->getNext() ?>" aria-label="<?= lang('Pager.next') ?>">
                <span aria-hidden="true"><?= lang('Pager.next') ?></span>
            </a>
        </li>
        <li class="items-pages">
            <a class="link-pages" href="<?= $pager->getLast() ?>" aria-label="<?= lang('Pager.last') ?>">
                <span aria-hidden="true"><?= lang('Pager.last') ?></span>
            </a>
        </li>
    <?php endif ?>
    </ul>
</nav>