import java.util.Random; 

public class MyTask implements Runnable { 
	private int start;	
	private int count;
	Random random = new Random();
	double rnd;
	
	public MyTask(int size) {
		this.start = size; 
    }
    
	public void run() {
    	for (int i=0; i <start; i++) {
    		rnd = random.nextDouble();
    		if (rnd < 0.5)
				count++;
    	}
    }
    public int getCount() {
    	return count; }
	}





