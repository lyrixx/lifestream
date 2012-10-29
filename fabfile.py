from fabric.api import local, abort, lcd, settings
from fabric.colors import red, green
from fabric.decorators import task
import os

@task
def post_commit(commit=None, push=False):
    """
    Call this task after a commit.
    Sample of post-commit hook:
    fab -f .../fabfile.py post_commit:commit=`git log -1 HEAD --pretty="%H"`
    """

    with lcd(get_current_project_path()):
        ret = local('git status --porcelain | \grep -v "??" | wc -l', capture=True)
    if (int(ret) > 0):
        local('notify-send "%s" "Directory (git) not clean"' % get_current_project_name())
        abort(red('Project is not clean. Impossible to commit anything'))

    update_doc()

    commit_doc(commit)
    local('notify-send "%s" "Doc Packaged"' % get_current_project_name())
    green('Doc built and commited')

    if (push):
        push_doc()

@task
def update_doc():
    with lcd(get_current_project_path()):
        with settings(warn_only=True):
            local('php vendor/bin/sami.php update _sami/sami.php --no-ansi --force --quiet')

@task
def commit_doc(commit=None):
    with lcd(get_current_project_path()):
        local('git add api')
        if (commit):
            message = 'Updated doc for \'%s\'' % commit
        else:
            message = 'Updated doc'
        local('git ci -m "%s"' % message)

@task
def push_doc():
    with lcd(get_current_project_path()):
        local('git push origin gh-pages')
    local('notify-send "%s" "Doc Pushed"' % get_current_project_name())

def get_current_project_name():
    return os.path.basename(get_current_project_path())

def get_current_project_path():
    return os.path.dirname(__file__)
