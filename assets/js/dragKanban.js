class dragKanban {
    constructor() {
        this.draggableTasks = document.querySelectorAll(`[data-ref="kanbanDraggableTask"]`);
        this.dropZones = document.querySelectorAll(`[data-ref="kanbanDropZone"]`);
        this.addEventListeners();
    }

    addEventListeners() {
        [].forEach.call(this.draggableTasks, (draggableTask) => {
            draggableTask.addEventListener('dragstart', (e) => {
                this.onDragStart(e);
            });
        });

        [].forEach.call(this.dropZones, (dropZone) => {
            dropZone.addEventListener('dragover', (e) => {
                this.onDragOver(e);
            });
            dropZone.addEventListener('drop', (e) => {
                this.onDrop(e);
            });
        });
    }

    onDragStart(event) {
        event
            .dataTransfer
            .setData('text/plain', event.target.dataset.id);
        event
            .target
            .style
            .backgroundColor = '#d4d6d8';
    };

    onDragOver(event) {
        event.preventDefault();
    };

    onDrop(event) {
        event.preventDefault();
        const id = event
            .dataTransfer
            .getData('text');

        const draggableTask = document.querySelector(`[data-id="${id}"]`);
        const dropZone = event.target.closest(`[data-ref="kanbanDropZone"]`);

        dropZone.appendChild(draggableTask);
        draggableTask.style.backgroundColor = 'white';

        event
            .dataTransfer
            .clearData();
    };

    static init() {
        return new this();
    }
}

document.addEventListener('load', dragKanban.init());
