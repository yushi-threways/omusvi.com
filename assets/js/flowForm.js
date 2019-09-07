var $collectionHolder;

// setup an "add a flow" link
var $addFlowButton = $('<button type="button" class="add_flow_link btn btn-light btn-sm">Add a Flow</button>');
var $newLinkLi = $('<div></div>').append($addFlowButton);

jQuery(document).ready(function() {
    // Get the ul that holds the collection of flows
    $collectionHolder = $('div#my_event_myEventFlows');

    $collectionHolder.find('div.flow-list').each(function() {
        addFlowFormDeleteLink($(this));
    });
    // add the "add a tasks" anchor and li to the tasks ul
    $collectionHolder.append($newLinkLi);

    // count the current form inputs we have (e.g. 2), use that as the new
    // index when inserting a new item (e.g. 2)
    $collectionHolder.data('index', $collectionHolder.find(':input').length);

    $addFlowButton.on('click', function(e) {
        // add a new flow form (see next code block)
        addFlowForm($collectionHolder, $newLinkLi);
    });
});

function addFlowForm($collectionHolder, $newLinkLi) {
    // Get the data-prototype explained earlier
    var prototype = $collectionHolder.data('prototype');
    
    // get the new index
    var index = $collectionHolder.data('index');
    
    // Replace '$$name$$' in the prototype's HTML to
    // instead be a number based on how many items we have
    var newForm = prototype.replace(/__name__/g, index);
    
    // increase the index with one for the next item
    $collectionHolder.data('index', index + 1);
    
    // Display the form in the page in an li, before the "Add a flow" link li
    var $newFormLi = $('<div class="flow-list"></div>').append(newForm);
    
    // also add a remove button, just for this example
    $newFormLi.append('<a href="#" class="remove-flow">x</a>');
    
    $newLinkLi.before($newFormLi);
    
    // handle the removal, just for this example
    $('.remove-flow').click(function(e) {
        e.preventDefault();
        
        $(this).parent().remove();
        
        return false;
    });
}

function addFlowFormDeleteLink($flowFormLi) {
    var $removeFormButton = $('<button type="button btn btn-light btn-sm">Delete this flow</button>');
    $flowFormLi.append($removeFormButton);

    $removeFormButton.on('click', function(e) {
        // remove the li for the flow form
        $FlowFormLi.remove();
    });
}