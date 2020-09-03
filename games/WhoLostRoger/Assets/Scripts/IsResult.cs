using System.Collections;
using System.Collections.Generic;
using UnityEngine;
using UnityEngine.UI;
using UnityEngine.SceneManagement;

public class IsResult : MonoBehaviour
{
    public enum Options
    {
        nothing = 0,
        jumpScene = 1,
    }

    public GameObject nounPanel;
    public Options options;
    [ChoiceList(new[] { "ResultScene", "GameoverScene" })]
    public string sceneName;

    private Text[] nounTextList;
    private bool trigger = false;

    private void checkNounPanel()
    {
        if (nounPanel == null)
        {
            IsResult component = this.gameObject.GetComponent<IsResult>();
            Destroy(component);

            Debug.Log(string.Format("Null noun panel assigned and the component won't work"));
        }
    }

    private void getNounTextList()
    {
        nounTextList = nounPanel.GetComponentsInChildren<Text>(true);
        Debug.Log(string.Format("In total '{0}' noun text box in this panel'", nounTextList.Length));
    }

    // trigger this event when noun object is clicked
    public void isAllNounClicked()
    {
        if (!trigger)
        {
            int count = 0;
            for (int i = 0; i < nounTextList.Length; ++i)
            {
                if (!nounTextList[i].gameObject.activeSelf)
                {
                    count++;
                }

                // extra one is for noun text header
                if (count + 1 == nounTextList.Length)
                {
                    trigger = true;
                    Debug.Log(string.Format("All nouns clicked."));
                }
            }

            if (trigger)
            {
                doSomething();
            }
        }
    }

    // do something when triggered
    private void doSomething()
    {
        switch (options)
        {
            case Options.nothing:
                doNothing();
                break;
            case Options.jumpScene:
                doJumpScene();
                break;
            default:
                break;
        }
    }

    // do nothing when timeout
    private void doNothing()
    {
        Debug.Log(string.Format("Do nothing when all nouns clicked",
            this.gameObject.ToString()));
    }

    // jump to other scene when timeout
    private void doJumpScene()
    {
        if ((sceneName != null) && (SceneManager.GetSceneByName(sceneName) != null))
        {
            SceneManager.LoadScene(sceneName);
            Debug.Log(string.Format("All nouns found : load to '{0}' scene", sceneName));
        }
        else
        {
            Debug.Log(string.Format("All nouns found : no such scene name"));
        }
    }

    /* ********************************************************************************* *
     * ****************************** CUSTOM STUFFS ABOVE ****************************** *
     * ********************************************************************************* */

    // Start is called before the first frame update
    void Start()
    {
        checkNounPanel();
        getNounTextList();
    }

    // Update is called once per frame
    void Update()
    {

    }
}
