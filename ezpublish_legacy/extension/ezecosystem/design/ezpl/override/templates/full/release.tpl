<div class="border-box">
<div class="border-tl"><div class="border-tr"><div class="border-tc"></div></div></div>
<div class="border-ml"><div class="border-mr"><div class="border-mc float-break">

<div class="content-view-full">
    <div class="class-{$node.object.class_identifier}">

    <div class="attribute-header">
        <h1>{$node.name|wash()}</h1>
    </div>

    {*
     This is a general full view template
     It is intended to accelerate web development by elimineting the need to create templates for simple classes
     It probes the name_pattern for attributes and has some pre set attributes that are hidden
     The output are quite stylable, so you can do visual modifications with css

     The pre set optional attributes are:
     'enable_comments' a checkbox to indicates if you want to enable comments or not
     'enable_tipafriend' a checkbox to indicates if you want to enable tipp a friend or not
     'show_children' a checkbox to indicates if you want to show children or not
     'show_children_exclude' a text_line with classes you want to exclude, like: 'article,infobox,folder'
     'show_children_pr_page' a Integer with the number of children you want to show pr page
    *}

    {def $name_pattern = $node.object.content_class.contentobject_name|explode('>')|implode(',')
         $name_pattern_array = array('enable_comments', 'enable_tipafriend', 'show_children', 'show_children_exclude', 'show_children_pr_page')}
    {set $name_pattern  = $name_pattern|explode('|')|implode(',')}
    {set $name_pattern  = $name_pattern|explode('<')|implode(',')}
    {set $name_pattern  = $name_pattern|explode(',')}
    {foreach $name_pattern  as $name_pattern_string}
        {set $name_pattern_array = $name_pattern_array|append( $name_pattern_string|trim() )}
    {/foreach}

    {if $node.data_map.short_description.has_content}
    <div class="attribute-{$node.data_map.short_description.contentclass_attribute_identifier}">
        <a name="short_description"></a>
        {attribute_view_gui attribute=$node.data_map.short_description}
    </div>
    {/if}

    {if $node.data_map.requirements.has_content}
    <div class="attribute-{$node.data_map.requirements.contentclass_attribute_identifier}">
        <a name="requirements"></a>
        <h2>{$node.data_map.requirements.contentclass_attribute_name}</h2>
        {attribute_view_gui attribute=$node.data_map.requirements}
    </div>
    {/if}

    {if $node.data_map.packages.has_content}
    <div class="attribute-{$node.data_map.packages.contentclass_attribute_identifier}">
        <a name="packages"></a>
        <h2>{$node.data_map.packages.contentclass_attribute_name}</h2>
        {attribute_view_gui attribute=$node.data_map.packages}
    </div>
    {/if}

    {if $node.data_map.extensions.has_content}
    <div class="attribute-{$node.data_map.extensions.contentclass_attribute_identifier}">
        <a name="extensions"></a>
        <h2>{$node.data_map.extensions.contentclass_attribute_name}</h2>
        {attribute_view_gui attribute=$node.data_map.extensions}
    </div>
    {/if}

    {if $node.data_map.upstream_mirror.has_content}
    <div class="attribute-{$node.data_map.upstream_mirror.contentclass_attribute_identifier}">
        <p>Upstream Download: {attribute_view_gui attribute=$node.data_map.upstream_mirror}</p>
    </div>
    {/if}

    {if $node.data_map.description.has_content}
    <div class="attribute-{$node.data_map.description.contentclass_attribute_identifier}">
        <a name="description"></a>
        <h2>{$node.data_map.description.contentclass_attribute_name}</h2>
        {attribute_view_gui attribute=$node.data_map.description}
    </div>
    {/if}

    {if $node.data_map.release_notes.has_content}
    <div class="attribute-{$node.data_map.release_notes.contentclass_attribute_identifier}">
        <a name="release_notes"></a>
        <h2>{$node.data_map.release_notes.contentclass_attribute_name} - {$node.name}</h2>
        {attribute_view_gui attribute=$node.data_map.release_notes}
    </div>
    {/if}

    {if $node.data_map.upgrade_notes.has_content}
    <div class="attribute-{$node.data_map.upgrade_notes.contentclass_attribute_identifier}">
        <a name="upgrade_notes"></a>
        <h2>{$node.data_map.upgrade_notes.contentclass_attribute_name}</h2>
        {attribute_view_gui attribute=$node.data_map.upgrade_notes}
    </div>
    {/if}

    {if $node.data_map.changelog.has_content}
    <div class="attribute-{$node.data_map.changelog.contentclass_attribute_identifier}">
        <a name="changelog"></a>
        <h2>{$node.data_map.changelog.contentclass_attribute_name}</h2>
        {attribute_view_gui attribute=$node.data_map.changelog}
    </div>
    {/if}

    {if $node.data_map.tags.has_content}
    <div class="attribute-{$node.data_map.tags.contentclass_attribute_identifier}">
        <a name="tags"></a>
        <h2>{$node.data_map.tags.contentclass_attribute_name}</h2>
        {attribute_view_gui attribute=$node.data_map.tags}
    </div>
    {/if}

    {if $node.object.content_class.is_container}
        {* if and( is_unset( $versionview_mode ), is_set( $node.data_map.enable_comments ), $node.data_map.enable_comments.data_int )}
            <h1>{"Comments"|i18n("design/ezwebin/full/article")}</h1>
                <div class="content-view-children">
                    {foreach fetch_alias( comments, hash( parent_node_id, $node.node_id ) ) as $comment}
                        {node_view_gui view='line' content_node=$comment}
                    {/foreach}
                </div>

                {if fetch( 'content', 'access', hash( 'access', 'create',
                                                      'contentobject', $node,
                                                      'contentclass_id', 'comment' ) )}
                    <form method="post" action={"content/action"|ezurl}>
                    <input type="hidden" name="ClassIdentifier" value="comment" />
                    <input type="hidden" name="NodeID" value="{$node.object.main_node.node_id}" />
                    <input type="hidden" name="ContentLanguageCode" value="{ezini( 'RegionalSettings', 'ContentObjectLocale', 'site.ini')}" />
                    <input class="button new_comment" type="submit" name="NewButton" value="{'New comment'|i18n( 'design/ezwebin/full/article' )}" />
                    </form>
                {else}
                    {if ezmodule( 'user/register' )}
                        <p>{'%login_link_startLog in%login_link_end or %create_link_startcreate a user account%create_link_end to comment.'|i18n( 'design/ezwebin/full/article', , hash( '%login_link_start', concat( '<a href="', '/user/login'|ezurl(no), '">' ), '%login_link_end', '</a>', '%create_link_start', concat( '<a href="', "/user/register"|ezurl(no), '">' ), '%create_link_end', '</a>' ) )}</p>
                    {else}
                        <p>{'%login_link_startLog in%login_link_end to comment.'|i18n( 'design/ezwebin/article/comments', , hash( '%login_link_start', concat( '<a href="', '/user/login'|ezurl(no), '">' ), '%login_link_end', '</a>' ) )}</p>
                    {/if}
                {/if *}
        {if and( $node.parent.node_id|eq( ezini( 'NodeIDSettings', 'DownloadsNodeID', 'ezpublishlegacy.ini' ) ), is_set( $node.data_map.show_children ), $node.data_map.show_children.data_int )}
                {def $page_limit = first_set($node.data_map.show_children_pr_page.data_int, 10)
                     $classes = ezini( 'MenuContentSettings', 'ExtraIdentifierList', 'menu.ini' )
                     $children_count = ''}
                {if is_set( $node.data_map.show_children_exclude )}
                    {set $classes = $node.data_map.show_children_exclude.content|explode(',')}
                {/if}

                {set $children_count=fetch_alias( 'children_count', hash( 'parent_node_id', $node.node_id,
                                                                          'class_filter_type', 'exclude',
                                                                          'class_filter_array', $classes ) )}

                <div class="content-view-children">
                    {if $children_count}
                    <div><h2>Releases</h2></div>
                        {foreach fetch_alias( 'children', hash( 'parent_node_id', $node.node_id,
                                                                'offset', $view_parameters.offset,
                                                                'sort_by', $node.sort_array,
                                                                'class_filter_type', 'exclude',
                                                                'class_filter_array', $classes,
                                                                'limit', $page_limit ) ) as $child }
                            {node_view_gui view='line' content_node=$child}
                        {/foreach}
                    {/if}
                </div>

                {include name=navigator
                         uri='design:navigator/google.tpl'
                         page_uri=$node.url_alias
                         item_count=$children_count
                         view_parameters=$view_parameters
                         item_limit=$page_limit}

        {/if}
    {/if}

    {* if and( is_unset( $versionview_mode ), is_set( $node.data_map.enable_tipafriend ), $node.data_map.enable_tipafriend.data_int )}
        {def $tipafriend_access=fetch( 'user', 'has_access_to', hash( 'module', 'content',
                                                                      'function', 'tipafriend' ) )}
        {if and( ezmodule( 'content/tipafriend' ), $tipafriend_access )}
        <div class="attribute-tipafriend">
            <p><a href={concat( "/content/tipafriend/", $node.node_id )|ezurl} title="{'Tip a friend'|i18n( 'design/ezwebin/full/article' )}">{'Tip a friend'|i18n( 'design/ezwebin/full/article' )}</a></p>
        </div>
        {/if}
    {/if *}

    </div>
</div>

</div></div></div>
<div class="border-bl"><div class="border-br"><div class="border-bc"></div></div></div>
</div>