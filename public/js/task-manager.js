document.addEventListener('DOMContentLoaded', () => {
    const tasks = document.querySelectorAll('.task-card');
    console.log('Tâches trouvées:', tasks.length);
  
    function markAsComplete(taskId) {
      const taskElement = document.querySelector(`#task-${taskId}`);
      if (taskElement) {
        taskElement.classList.toggle('completed'); // Utilisez 'toggle' pour ajouter/supprimer la classe
        const status = taskElement.classList.contains('completed') ? 'completed' : 'not-completed';
        localStorage.setItem(`task-${taskId}`, status);
        console.log(`Tâche ${taskId} marquée comme`, status);
      } else {
        console.error('Élément de tâche non trouvé:', taskId);
      }
    }
  
    function checkCompletedTasks() {
      tasks.forEach(task => {
        const taskId = task.id.split('-')[1];
        const taskStatus = localStorage.getItem(`task-${taskId}`);
        if (taskStatus === 'completed') {
          task.classList.add('completed');
        } else {
          task.classList.remove('completed');
        }
      });
    }
  
    tasks.forEach(task => {
      const taskId = task.id.split('-')[1];
      const completeButton = task.querySelector('.toggle-complete');
      if (completeButton) {
        completeButton.addEventListener('click', () => markAsComplete(taskId));
      } else {
        console.error('Bouton de complétion non trouvé dans la tâche:', taskId);
      }
    });
  
    checkCompletedTasks();
    window.addEventListener('focus', checkCompletedTasks);
  });
  